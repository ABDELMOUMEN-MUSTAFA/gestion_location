<?php

class Categorie
{
    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function all()
    {
    	$query = $this->connect->prepare("SELECT * FROM categories");

        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);

		if($query->rowCount() > 0) { 
			return $categories;
		}

		return false;
    }

}