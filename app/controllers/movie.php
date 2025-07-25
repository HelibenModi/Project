<?php
class Movie extends Controller {

    public function index() {
        $title = $_GET['title'] ?? '';

        if (!empty($title)) {
            // Internally forward to search() method if a title is present.
            $this->search($title);
        } else {
            // If no title provided, load the search form view.
            $this->view('movie/index');
        }
    }

    public function search($title = null) {
        // Support both GET param and direct method call
        $title = $title ?? ($_GET['title'] ?? '');

        if (empty($title)) {
            $this->view('movie/index', ['error' => 'Please enter a movie title.']);
            return;
        }

        $api = $this->model('Api');
        $movie = $api->searchMovie($title);

        if (!$movie || $movie['Response'] === 'False') {
            $this->view('movie/results', [
                'movie' => null,
                'review' => null,
                'title' => $title,
                'error' => 'Movie not found. Please try another title.'
            ]);
            return;
        }

        $review = $api->generateReview($movie['Title']);

        $this->view('movie/results', [
            'movie' => $movie,
            'review' => $review,
            'title' => $movie["Title"]
        ]);
    }
}
?>
