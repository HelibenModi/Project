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

}