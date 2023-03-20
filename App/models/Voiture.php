<?php

class Voiture
{
    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

    public function all($date_depart, $agence_depart)
    {
    	$query = $this->connect->prepare("
			SELECT 
				v.matricule,
				marque, 
				prix_jour,
				climatisation,
				photo, 
				nombre_portes, 
				nombre_passagers, 
				nombre_valises, 
				boite_vitesses, 
				annee_permis_min, 
				franchise_accedent, 
				franchise_vol, 
				caution, 
				titre, 
				sous_titre, 
				type_carburant, 
				gps_integre, 
				logo, 
				DATE_FORMAT(date_depart, '%d/%m/%Y') AS date_depart,
				DATE_FORMAT(date_retour, '%d/%m/%Y %H:%i') AS date_retour,
				IF(:new_date_depart >= DATE_ADD(date_retour, interval 15 MINUTE) OR date_retour IS NULL, 1, 0) AS is_disponible
			FROM voitures v
			LEFT JOIN locations l ON v.matricule = l.matricule
			WHERE v.agence_id = :agence_depart
    	");


    	$query->bindParam(':agence_depart', $agence_depart, PDO::PARAM_INT);
    	$query->bindParam(':new_date_depart', $date_depart, PDO::PARAM_STR);

        $query->execute();
        $voitures = $query->fetchAll(PDO::FETCH_OBJ);

		if($query->rowCount() > 0) {
			foreach ($voitures as $v) {
				$v->matricule = (int) $v->matricule;
				$v->is_disponible = (bool) $v->is_disponible;
				if($v->is_disponible){
					unset($v->date_depart);
					unset($v->date_retour);
				}
				$v->photo = URLROOT.'/public/images/voitures/images/'.$v->photo;
				$v->logo = URLROOT.'/public/images/voitures/logos/'.$v->logo;
				$v->climatisation = (bool) $v->climatisation;
				$v->gps_integre = (bool) $v->gps_integre;
			} 
			return $voitures;
		}

		return [];
    }

    public function findByCategorie($categorie_id, $date_depart, $agence_depart)
    {
    	$query = $this->connect->prepare("
			SELECT 
				v.matricule,
				marque, 
				prix_jour,
				climatisation,
				photo, 
				nombre_portes, 
				nombre_passagers, 
				nombre_valises, 
				boite_vitesses, 
				annee_permis_min, 
				franchise_accedent, 
				franchise_vol, 
				caution, 
				titre, 
				sous_titre, 
				type_carburant, 
				gps_integre, 
				logo, 
				DATE_FORMAT(date_depart, '%d/%m/%Y') AS date_depart,
				DATE_FORMAT(date_retour, '%d/%m/%Y') AS date_retour,
				IF(:new_date_depart >= DATE_ADD(date_retour, interval 15 MINUTE) OR date_retour IS NULL, 1, 0) AS is_disponible
			FROM voitures v
			JOIN agences a ON v.agence_id = a.id
			LEFT JOIN locations l ON v.matricule = l.id
			WHERE a.id = :agence_depart AND categorie_id = :categorie_id
    	");

    	$query->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    	$query->bindParam(':agence_depart', $agence_depart, PDO::PARAM_INT);
    	$query->bindParam(':new_date_depart', $date_depart, PDO::PARAM_STR);
        $query->execute();
        $voitures = $query->fetchAll(PDO::FETCH_OBJ);

		if($query->rowCount() > 0) {
			foreach ($voitures as $v) {
				$v->matricule = (int) $v->matricule;
				$v->is_disponible = (bool) $v->is_disponible;
				if($v->is_disponible){
					unset($v->date_depart);
					unset($v->date_retour);
				}
				$v->photo = URLROOT.'/public/images/voitures/images/'.$v->photo;
				$v->logo = URLROOT.'/public/images/voitures/logos/'.$v->logo;
				$v->climatisation = (bool) $v->climatisation;
				$v->gps_integre = (bool) $v->gps_integre;
			} 
			return $voitures;
		}

		return [];
    }

    public function carExistsAndAvailable($matricule, $date_depart, $agence_depart)
    {
    	$query = $this->connect->prepare("
			SELECT 
				v.matricule,
				marque, 
				prix_jour,
				climatisation,
				photo, 
				nombre_portes, 
				nombre_passagers, 
				nombre_valises, 
				boite_vitesses, 
				annee_permis_min, 
				franchise_accedent, 
				franchise_vol, 
				caution, 
				titre, 
				sous_titre, 
				type_carburant, 
				gps_integre, 
				logo,
				DATE_FORMAT(date_depart, '%d/%m/%Y') AS date_depart,
				DATE_FORMAT(date_retour, '%d/%m/%Y') AS date_retour,
				IF(:new_date_depart >= DATE_ADD(date_retour, interval 15 MINUTE) OR date_retour IS NULL, 1, 0) AS is_disponible
			FROM voitures v
			JOIN agences a ON v.agence_id = a.id
			LEFT JOIN locations l ON v.matricule = l.id
			WHERE a.id = :agence_depart AND v.matricule = :matricule
    	");

    	$query->bindParam(':agence_depart', $agence_depart, PDO::PARAM_INT);
    	$query->bindParam(':new_date_depart', $date_depart, PDO::PARAM_STR);
    	$query->bindParam(':matricule', $matricule, PDO::PARAM_INT);

        $query->execute();
        $v = $query->fetch(PDO::FETCH_OBJ);

		if($query->rowCount() > 0) {
			$v->matricule = (int) $v->matricule;
			$v->is_disponible = (bool) $v->is_disponible;
			if($v->is_disponible){
				unset($v->date_depart);
				unset($v->date_retour);
			}
			$v->photo = URLROOT.'/public/images/voitures/images/'.$v->photo;
			$v->logo = URLROOT.'/public/images/voitures/logos/'.$v->logo;
			$v->climatisation = (bool) $v->climatisation;
			$v->gps_integre = (bool) $v->gps_integre;
			return $v;
		}

		return false;
    }

}