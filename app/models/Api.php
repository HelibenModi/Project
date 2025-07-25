<?php
class Api {
    private $omdbKey;
    private $geminiKey;

    public function __construct() {
        $this->omdbKey = $_ENV['OMDB_API_KEY'] ?? null;
        $this->geminiKey = $_ENV['GEMINI'] ?? null;

        echo "<pre>";
        echo "OMDB Key: " . ($this->omdbKey ?: 'MISSING') . "\n";
        echo "GEMINI Key: " . ($this->geminiKey ?: 'MISSING') . "\n";
        echo "</pre>";
    

        // Debug to verify keys are loaded (only for testing, remove later)
        echo "<pre>OMDB Key: {$this->omdbKey}\nGEMINI Key: {$this->geminiKey}</pre>";
    }

    public function searchMovie($title)
    {
        $title = urlencode($title);
        $url = "http://www.omdbapi.com/?apikey={$this->omdbKey}&t=$title";

        echo "<pre>OMDB URL: $url</pre>";
        $response = file_get_contents($url);

        $movie = json_decode($response, true);
        return $movie;
       

    }


    public function generateReview($title, $plot)
    {
        if (empty($plot)) return "No plot available for review.";

        $prompt = "Write a short AI review for the movie '$title'. Plot: $plot";

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $this->geminiKey;

        $data = array(
            "contents" => array(
                array(
                    "role" => "user",
                    "parts" => array(
                        array("text" => $prompt)
                    )
                )
            )
        );

        $json_data = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Optional: disable SSL verification (only for local dev/testing)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'CURL error: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        return $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'AI review not available.';
    }
}