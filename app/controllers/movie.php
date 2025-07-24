<?php

require_once 'app/models/Api.php';
require_once 'app/models/User.php'; // if needed for user data
//require_once 'database.php'; // your PDO instance

class Movie extends Controller
{
    private $api;
    private $db;

    public function __construct()
    {
        $this->api = new Api();
        global $pdo;
        $this->db = $pdo;
    }

    public function index()
    {
        $this->view('movie/search');
    }
        public function search()
        {
            $title = $_GET['title'] ?? '';

            if (empty($title)) {
                echo "No title provided.";
                return;
            }

            $api = $this->model('Api');
            $movie = $api->fetchMovie($title);

            if (!$movie || $movie['Response'] === 'False') {
                $this->view('movie/notfound', ['title' => $title]);
            } else {
                $this->view('movie/show', ['movie' => $movie]);
            }
        }

    public function rate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['rating'])) {
            $stmt = $this->db->prepare("INSERT INTO ratings (movie_title, rating) VALUES (?, ?)");
            $stmt->execute([$_POST['title'], $_POST['rating']]);
            header("Location: /movie/search?title=" . urlencode($_POST['title']));
        }
    }
    public function review()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
                $title = $_POST['title'];
                $prompt = "Write a short review for the movie titled '$title'.";
                $review = $this->api->generateReview($prompt);
                echo json_encode(['review' => $review]);
            }
        }
    
}