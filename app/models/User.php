<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

   public function authenticate($username, $password) {
    $username = strtolower($username);
    $db = db_connect();

    // SESSION LOCKOUT LOGIC
    if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3) {
        $elapsed = time() - ($_SESSION['lastFailedTime'] ?? 0);

        if ($elapsed < 60) {
            $remaining = 60 - $elapsed;
            $_SESSION['error'] = "Too many login attempts. Try again in {$remaining} seconds.";
            header('Location: /login');
            exit;
        } else {
            // Lockout expired
            $_SESSION['failedAuth'] = 0;
            unset($_SESSION['lastFailedTime']);
        }
    }
     // Proceed to verify credentials
      $statement = $db->prepare("SELECT * FROM users WHERE username = :name;");
      $statement->bindValue(':name', $username);
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
     if ($rows && password_verify($password, $rows['password'])) {
              $_SESSION['auth'] = 1;
              $_SESSION['username'] = ucwords($username);
              $_SESSION['success'] = "Welcome, " . ucwords($username) . "!";
              unset($_SESSION['failedAuth'], $_SESSION['lastFailedTime']);
              $this->logAttempt($username, 'success');
              header('Location: /home');
              exit;
          } else {
              // Log failed attempt
              $_SESSION['failedAuth'] = ($_SESSION['failedAuth'] ?? 0) + 1;
              $_SESSION['lastFailedTime'] = time();

              $_SESSION['error'] = "Invalid username or password.";
              $this->logAttempt($username, 'fail'); 
              header('Location: /login');
              exit;
          }
      
   }
  private function logAttempt($username, $status) {
      $db = db_connect();
      $stmt = $db->prepare("INSERT INTO login_logs (username, was_success) VALUES (:username, :was_success)");
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':was_success', $status === 'success' ? 1 : 0, PDO::PARAM_INT);
      $stmt->execute();
  }
  public function register($username, $password) {
  $db = db_connect();

  // Check if user exists
  $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->bindValue(':username', strtolower($username));
  $stmt->execute();
  if ($stmt->fetch()) {
      die('Username already taken.');
  }
    // Hash password
    $hashed = password_hash($password, PASSWORD_DEFAULT);
     $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
     $stmt->bindValue(':username', strtolower($username));
     $stmt->bindValue(':password', $hashed);
     $stmt->execute();
}
}