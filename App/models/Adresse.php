<?php

class Adresse {
	private $connect;
	public $ville;
    public $rue;
    public $province;
    public $code_postal;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function save()
    {
    	$query = $this->connect->prepare("INSERT INTO adresses VALUES(DEFAULT, :ville, :rue, :province, :code_postal)");

    	$query->bindParam(':ville', $this->ville, PDO::PARAM_STR);
    	$query->bindParam(':rue', $this->rue, PDO::PARAM_STR);
    	$query->bindParam(':province', $this->province, PDO::PARAM_STR);
    	$query->bindParam(':code_postal', $this->code_postal, PDO::PARAM_STR);
    	$query->execute();

    	$lastInsertId = $this->connect->lastInsertId();
		if($lastInsertId > 0) { 
			return $lastInsertId;
		}
		return false;
    }

    public function edit($adresse_id)
    {
       $query = $this->connect->prepare("
            UPDATE adresses
            SET 
                ville = :ville, 
                rue = :rue, 
                province = :province, 
                code_postal = :code_postal
            WHERE
                id = :adresse_id
        ");

        $query->bindParam(':ville', $this->ville, PDO::PARAM_STR);
        $query->bindParam(':rue', $this->rue, PDO::PARAM_STR);
        $query->bindParam(':province', $this->province, PDO::PARAM_STR);
        $query->bindParam(':code_postal', $this->code_postal, PDO::PARAM_STR);
        $query->bindParam(':adresse_id', $adresse_id, PDO::PARAM_INT);
        $query->execute();

        if($query -> rowCount() > 0) { 
            return $query->rowCount(); 
        } 
        return false;
    }
}