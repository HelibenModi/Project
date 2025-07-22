<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');
      $data = $user->test();
			$this->view('movie/search', $data);
	    $url = 
  "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=YOUR_GEMINI_API_KEY";

      $data = array(
        "contents" => array(
            array(
              "role" =>"user",
                "parts" => array(
                    array(
                        "text" => "Write a short review for the movie titled 'Inception'."
                    )
                )
            )
        )
      );
      $json_data = json_encode($data);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_VERIFYPEER, false);
      $response = curl_exec($ch);
      curl_close($ch);
      if(curl_errno($ch)){
        echo 'CURL error: ' . curl_error($ch);
      }
      echo "<pre>";
      echo $response;
      die;
        }
        }


