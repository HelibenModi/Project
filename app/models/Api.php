<?php
class Api {
    private $omdbKey;
    private $geminiKey;

    public function __construct() {
        $this->omdbKey = $_ENV['OMDB_API_KEY'] ?? null;
        $this->geminiKey = $_ENV['GEMINI'] ?? null;
    }

    public function searchMovie($title) {
        $title = urlencode($title);
        $url = "http://www.omdbapi.com/?apikey={$this->omdbKey}&t=$title";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    public function generateReview($title) {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $this->geminiKey;

        $prompt = "Write a short AI review for the movie titled '{$title}'.";

        $data = [
            "contents" => [
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ]
        ];

        $json_data = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'CURL Error: ' . curl_error($ch);
        }

        curl_close($ch);

        $responseData = json_decode($response, true);
        return $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'AI review not available.';
    }
}
?>
