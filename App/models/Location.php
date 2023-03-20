<?php

class Location
{
    private $connect;
    public $date_depart;
    public $date_retour;
    public $prix;
    public $matricule;
    public $client_id;
    public $agence_depart;
    public $agence_retour;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function save()
    {
    	$query = $this->connect->prepare("INSERT INTO locations VALUES(DEFAULT, :date_depart, :date_retour, :prix, :client_id, :matricule, :agence_depart, :agence_retour, DEFAULT)");

    	$query->bindParam(':date_depart', $this->date_depart, PDO::PARAM_STR);
    	$query->bindParam(':date_retour', $this->date_retour, PDO::PARAM_STR);
    	$query->bindParam(':prix', $this->prix, PDO::PARAM_STR);
    	$query->bindParam(':client_id', $this->client_id, PDO::PARAM_INT);
    	$query->bindParam(':matricule', $this->matricule, PDO::PARAM_INT);
    	$query->bindParam(':agence_depart', $this->agence_depart, PDO::PARAM_INT);
    	$query->bindParam(':agence_retour', $this->agence_retour, PDO::PARAM_INT);
		$query->execute();

		$lastInsertId = $this->connect->lastInsertId();
		if($lastInsertId > 0) { 
			return $lastInsertId;
		}
		return false;
    }

    public function find($client_id)
    {
        $query = $this->connect->prepare("
            SELECT
                l.id,
                date_depart,
                date_retour,
                v.matricule,
                v.titre,
                marque,
                l.prix,
                photo,
                climatisation,
                nombre_portes,
                nombre_passagers,
                nombre_valises,
                boite_vitesses,
                gps_integre,
                type_carburant,
                (SELECT nom FROM agences a WHERE l.agence_depart = a.id) AS agence_depart,
                (SELECT nom FROM agences a WHERE l.agence_retour = a.id) AS agence_retour
            FROM locations l
            JOIN voitures v ON l.matricule = v.matricule
            WHERE client_id = :client_id
        ");

        $query->bindParam(':client_id', $client_id, PDO::PARAM_INT);
        $query->execute();
        $locations = $query->fetchAll(PDO::FETCH_OBJ);
        
        if($query->rowCount() > 0) { 
            foreach ($locations as $l) {
                $l->photo = URLROOT.'/public/images/voitures/images/'.$l->photo;
            }
            return $locations;
        }

        return [];
    }

    public function hasLocationNoExpire($client_id) 
    {
        $query = $this->connect->prepare("
            SELECT
                COUNT(*) AS nbr_location
            FROM locations
            WHERE client_id = :client_id AND date_retour > NOW()
        ");

        $query->bindParam(':client_id', $client_id, PDO::PARAM_INT);
        $query->execute();
        $location = $query->fetch(PDO::FETCH_OBJ);
        
        if($query->rowCount() > 0) { 
            if($location->nbr_location === 0){
                return false;
            }
            return true;
        }
        return false;
    }
}