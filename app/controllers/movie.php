<?php


class Movie extends Controller
{

    public function index()
    {
        $this->view('movie/index');
    }
        public function search()
        {
           if (!isset($_REQUEST['movie'])){
               
           }
               $api = $this->model('Api');
               $movie_title = $_REQUEST['movie'];
               $movie = $api->searchMovie($movie_title);

            echo "<pre>";
            print_r($movie);
            die;
            
$this->view('movie/results', ['$movie' => $movie]);
        }
    // public function rate()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['rating'])) {
    //         $stmt = $this->db->prepare("INSERT INTO ratings (movie_title, rating) VALUES (?, ?)");
    //         $stmt->execute([$_POST['title'], $_POST['rating']]);
    //         header("Location: /movie/search?title=" . urlencode($_POST['title']));
    //     }
    // }
    public function review($rating = '')
        {
            // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
            //     $title = $_POST['title'];
            //     $prompt = "Write a short review for the movie titled '$title'.";
            //     $review = $this->api->generateReview($prompt);
            //     echo json_encode(['review' => $review]);
            // }
        }
    
}