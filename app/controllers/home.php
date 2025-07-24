<?php
class Home extends Controller {

    public function index() {
        $user = $this->model('User');
        $data = $user->test();

        // Show search view
        $this->view('movie/search', $data);

        // Prepare Gemini API request
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=YOUR_GEMINI_API_KEY";

        $data = [
            "contents" => [
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => "Write a short review for the movie titled 'Inception'."]
                    ]
                ]
            ]
        ];

        $json_data = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Check if constant is defined before using
        if (defined('CURLOPT_VERIFYPEER')) {
            curl_setopt($ch, CURLOPT_VERIFYPEER, false);
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'CURL error: ' . curl_error($ch);
        }

        curl_close($ch);

        echo "<pre>";
        echo $response;
        die;
    }
}
