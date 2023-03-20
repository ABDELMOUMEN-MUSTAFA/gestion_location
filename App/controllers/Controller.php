<?php

// Require all helpers
require_once '../App/helpers/redirect.php';
require_once '../App/config/config.php';
require_once '../App/helpers/view.php';
require_once '../App/helpers/flash.php';
require_once '../App/helpers/old.php';


class Controller
{
    private $db;

    // Load Model
    public function model($model)
    {
        // DataBase Connection
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }

        // require that model
        require_once "../App/models/" . $model . ".php";

        // Keep only one instance of the PDO Object in the memory
        if($this->db !== null){
            return new $model($this->db);
        }

        // Instantiate this model
        return new $model($this->db);
    }

    // Load View
    public function view($view, $data = [])
    {
        // check for view file
        if (file_exists('../App/views/' . $view . '.php')) {
            extract($data);

            // require that view
            require_once "../App/views/" . $view . ".php";
        } else {
            die("View Does Not Exists !");
        }
    }

}
