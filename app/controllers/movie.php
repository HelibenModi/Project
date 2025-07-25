    <?php
    class Movie extends Controller {
    
        public function index() {
            $this->view('movie/index');
        }
    
        public function search()
        {
            $title = $_GET['title'] ?? '';

            if (empty($title)) {
                error_log("Search error: No title provided.");
                $this->view('movie/search', ['error' => 'Please enter a movie title.']);
                return;
            }

            $api = $this->model('Api');
            $movie = $api->searchMovie($title);

            // ✅ Debug log instead of die() and var_dump
            ob_start();
            var_dump($movie);
            file_put_contents('log.txt', ob_get_clean()); // This creates or overwrites log.txt

            // ⛔️ Don't use die() here — let the app continue
            if (!$movie || isset($movie['Error'])) {
                $this->view('movie/results', ['movie' => null, 'review' => null, 'title' => null]);
                return;
            }

            $review = $api->generateReview($movie['Title'], $movie['Plot']);

            $this->view('movie/results', [
                'movie' => $movie,
                'review' => $review,
                'title' => $movie['Title']
            ]);
        }


    
        public function review($title = '') {
            if (empty($title)) {
                die('Movie title is required for review.');
            }
    
            $api = $this->model('Api');
            $prompt = "Write a short review for the movie titled " . $title . ".";
            $reviewJson = $api->generateReview($prompt);
    
            $reviewArray = json_decode($reviewJson, true);
    
            $review = $reviewArray['candidates'][0]['content']['parts'][0]['text'] ?? 'AI review unavailable.';
    
            $this->view('movie/review', ['title' => $title, 'review' => $review]);
        }
        
        public function rate() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $movieTitle = $_POST['movie_title'];
                $rating = (int) $_POST['rating'];

                $db = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
                $stmt = $db->prepare("INSERT INTO ratings (movie_title, rating, created_at) VALUES (?, ?, NOW())");
                $stmt->execute([$movieTitle, $rating]);

                // Optional: Show thank you or redirect back to results
                header("Location: /movie/search?title=" . urlencode($movieTitle));
                exit;
            }
        }

    }
    ?>
    