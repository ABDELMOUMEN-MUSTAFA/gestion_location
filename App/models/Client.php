<?php

class Client
{
	private $connect;
    public $nom;
    public $prenom;
    public $cin;
    public $telephone;
    public $email;
    public $adresse_id;
    public $mdp;
    
    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function hashPassword($mdp)
    {
    	$this->mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }

    public function save()
    {
    	$query = $this->connect->prepare("INSERT INTO clients VALUES(DEFAULT, :nom, :prenom, :cin, :email, :telephone, :mdp, :adresse_id)");

    	$query->bindParam(':nom', $this->nom, PDO::PARAM_STR);
    	$query->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
    	$query->bindParam(':cin', $this->cin, PDO::PARAM_STR);
    	$query->bindParam(':email', $this->email, PDO::PARAM_STR);
    	$query->bindParam(':telephone', $this->telephone, PDO::PARAM_STR);
    	$query->bindParam(':mdp', $this->mdp, PDO::PARAM_STR);
    	$query->bindParam(':adresse_id', $this->adresse_id, PDO::PARAM_INT);
		$query->execute();

		$lastInsertId = $this->connect->lastInsertId();
		if($lastInsertId > 0) { 
			return $lastInsertId;
		}
		return false;
	}
    
    public function find()
    {
        $query = $this->connect->prepare("
            SELECT 
                c.id,
                nom,
                prenom,
                telephone,
                cin,
                email,
                adresse_id,
                ville,
                rue,
                province,
                code_postal,
                mot_de_passe
            FROM clients c 
            JOIN adresses a ON c.adresse_id = a.id 
            WHERE email=:email
        ");

        $query->bindParam(':email', $this->email);
        $query->execute();

        if($client = $query->fetch(PDO::FETCH_OBJ)){
            if(password_verify($this->mdp, $client->mot_de_passe)){
                unset($client->mot_de_passe);
                return $client;
            }
            throw new Exception("votre mot de passe est incorrect");
        }

        throw new Exception("ce mail n'existe pas");
        
    }

    public function findByEmail($email)
    {
        $query = $this->connect->prepare("
            SELECT 
                c.id,
                nom,
                prenom,
                telephone,
                cin,
                email,
                adresse_id,
                ville,
                rue,
                province,
                code_postal
            FROM clients c 
            JOIN adresses a ON c.adresse_id = a.id 
            WHERE email=:email
        ");

        $query->bindParam(':email', $email);
        $query->execute();

        if($client = $query->fetch(PDO::FETCH_OBJ)){
            return $client;
        }        
    }

    public function edit($client_id)
    {
       $query = $this->connect->prepare("
            UPDATE clients
            SET 
                nom = :nom, 
                prenom = :prenom, 
                cin = :cin, 
                email = :email, 
                telephone = :telephone
            WHERE
                id = :client_id
        ");

        $query->bindParam(':nom', $this->nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
        $query->bindParam(':cin', $this->cin, PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':telephone', $this->telephone, PDO::PARAM_STR);
        $query->bindParam(':client_id', $client_id, PDO::PARAM_INT);
        $query->execute();

        if($query -> rowCount() > 0) { 
            return $query->rowCount(); 
        } 
        return false;
    }
}