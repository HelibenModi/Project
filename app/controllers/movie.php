<?php
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
}