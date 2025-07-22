<?php

require_once 'app/models/Api.php';
require_once 'app/models/User.php'; // if needed for user data
require_once 'database.php'; // your PDO instance

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
        if (isset($_GET['title'])) {
            $title = trim($_GET['title']);
            $movie = $this->api->fetchMovie($title);

            // Calculate average rating from DB
            $stmt = $this->db->prepare("SELECT ROUND(AVG(rating), 1) AS avg_rating FROM ratings WHERE movie_title = ?");
            $stmt->execute([$title]);
            $avgRating = $stmt->fetch()['avg_rating'] ?? 'No ratings yet';

            $this->view('movie/show', [
                'movie' => $movie,
                'avgRating' => $avgRating
            ]);
        } else {
            header('Location: /movie');
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

}