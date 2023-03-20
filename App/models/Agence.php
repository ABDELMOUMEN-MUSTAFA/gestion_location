<?php

class Agence
{
    private $connect;
    
    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function all()
    {
    	$query = $this->connect->prepare("SELECT ag.id, nom, telephone, ville, rue  FROM agences ag JOIN adresses ad ON ag.adresse_id = ad.id");

        $query->execute();
        $agences = $query->fetchAll(PDO::FETCH_OBJ);

		if($query->rowCount() > 0) { 
			return $agences;
		}

		return false;
    }

    public function find($agence_id)
    {
        $query = $this->connect->prepare("SELECT ag.id, nom, telephone, ville, rue  FROM agences ag JOIN adresses ad ON ag.adresse_id = ad.id WHERE ag.id = :agence_id");

        $query->bindParam(':agence_id', $agence_id, PDO::PARAM_INT);

        $query->execute();
        $agence = $query->fetch(PDO::FETCH_OBJ);

        if($query->rowCount() > 0) { 
            return $agence;
        }

        return false;
    }

}