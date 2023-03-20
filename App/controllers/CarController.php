<?php

require_once 'Controller.php';

class CarController extends Controller {
	public function recherche()
	{
		$agence = $this->model('Agence');
		$categorie = $this->model('Categorie');

		$viewData['agences'] = $agence->all();
		$viewData['categories'] = $categorie->all();

		return view('searchCar', $viewData);
	}

	public function index($categorie_id = '')
	{
		if(!isset($_GET['agence_depart'], $_GET['agence_retour'], $_GET['date_depart'], $_GET['date_retour'], $_GET['heure_depart'], $_GET['heure_retour'])){
			redirect('car/recherche');
			exit; 
		}

		$isValid = $this->validation($_GET);
		if(!$isValid){
			redirect('car/recherche');
			exit;
		}

		extract($_GET);
		
		$voiture = $this->model('Voiture');
		if(empty($categorie_id)){
			echo json_encode($voiture->all($date_depart.' '.$heure_depart, $agence_depart));
		}else{
			if(is_numeric($categorie_id)){
				echo json_encode($voiture->findByCategorie($categorie_id, $date_depart.' '.$heure_depart, $agence_depart));
			}else{
				redirect('car/recherche');
				exit;
			}
		}

		unset($_GET['url']);
		$_SESSION['location_details'] = $_GET;
	}

	private function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

	private function validation($data){
		$agence = $this->model('Agence');

		if (!is_numeric($data['agence_depart'])) {
			return false;
		}else{
			if(!$agence->find($data['agence_depart'])){
				return false;
			}
		}

		if (!is_numeric($data['agence_retour'])) {
			return false;
		}else{
			if(!$agence->find($data['agence_retour'])){
				return false;
			}
		}

		if (!$this->validateDate($data['date_depart'].' '.$data['heure_depart'].':00')) {
			return false;
		}
		
		if (!$this->validateDate($data['date_retour'].' '.$data['heure_retour'].':00')) {
			return false;
		}

		// check if date retour bigger then date depart
		$dateTimeDepart = $data['date_depart'].' '.$data['heure_depart'].':00';
		$dateTimeRetour = $data['date_retour'].' '.$data['heure_retour'].':00';
		if($dateTimeDepart >= $dateTimeRetour){
			return false;
		}

		// check if date depart bigger then now
		$now = date_create()->format('Y-m-d H:i:s');
		if($now >= $dateTimeDepart){
			echo $now. ' >= '.$dateTimeDepart;
			return false;
		}

		return true;
	}


}