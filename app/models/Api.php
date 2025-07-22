<?php
class Api {
    private $omdbKey;
    private $geminiKey;

    public function __construct() {
        $this->omdbKey = getenv('YOUR_OMDB_API_KEY');
        $this->geminiKey = getenv('YOUR_GEMINI_API_KEY');
    }

    public function fetchMovie($title) {
        $url = "http://www.omdbapi.com/?t=" . urlencode($title) . "&apikey=" . $this->omdbKey;
        return json_decode(file_get_contents($url), true);
    }

    public function generateReview($prompt) {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $this->geminiKey;

        $data = json_encode([
            "contents" => [[
                "parts" => [[ "text" => $prompt ]]
            ]]
        ]);

        $opts = ['http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json",
            'content' => $data
        ]];

        $ctx = stream_context_create($opts);
        $res = file_get_contents($url, false, $ctx);
        $json = json_decode($res, true);

        return $json['candidates'][0]['content']['parts'][0]['text'] ?? 'AI review unavailable.';
    }
}
