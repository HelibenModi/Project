<?php
class Create extends Controller {

    public function index() {
        
        $this->view('create/index');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (empty($username) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = "All fields are required.";
                header('Location: /create/index');
                exit;
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = "Passwords do not match.";
                header('Location: /create/index');
                exit;
            }

            // Password strength validation in PHP (server-side)
            if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
                $_SESSION['error'] = "Password must contain uppercase, lowercase, number and be at least 8 characters long.";
                header('Location: /create/index');
                exit;
            }

            $user = $this->model('User');
            if ($user->userExists($username)) {
                $_SESSION['error'] = "Username already taken.";
                header('Location: /create/index');
                exit;
            }

            $user->register($username, $password);
            $_SESSION['success'] = "Account created successfully. Please log in.";
            header('Location: /login/index');
            exit;
        }
    }
}