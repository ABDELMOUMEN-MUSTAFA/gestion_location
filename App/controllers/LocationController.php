<?php

require_once 'Controller.php';

class LocationController extends Controller {
	function __construct(){
		if(!isset($_SESSION['client'])){
			// redirect to Login Page
			flash('mustLogin', 'Veuillez se connecter pour louer une voiture', 'alert alert-info');
			redirect('login');
			exit;
		}
	}

	public function index($matricule = null)
	{
		if(!isset($_SESSION['location_details'])){
			// redirect to Search Page
			redirect('car/recherche');
			exit;
		}

		if(is_null($matricule)){
			// redirect to Search Page
			redirect('car/recherche');
			exit;
		}

		extract($_SESSION['location_details']);


		$v = $this->model('Voiture');
		$date_d = $date_depart.' '.$heure_depart;


		$voiture_info = $v->carExistsAndAvailable($matricule, $date_d, $agence_depart);
		if(!$voiture_info){
			// redirect to Search Page
			redirect('car/recherche');
			exit;
		}

		$ag = $this->model('Agence');
		$voiture_info->agence_depart = $ag->find($agence_depart);
		$voiture_info->agence_retour = $ag->find($agence_retour);
		$_SESSION['location_details']['total_jour_location'] = $this->calculDiffDate($date_retour, $date_depart);
		$_SESSION['location_details']['matricule'] = $matricule;
		$_SESSION['location_details']['prix_total'] = $_SESSION['location_details']['total_jour_location'] * $voiture_info->prix_jour;
		return view('location', ['voiture_info' => $voiture_info, 'date_depart' => $this->formatDate($date_depart), 'date_retour' =>  $this->formatDate($date_retour)]);
	}

	public function create()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			if(!isset($_SESSION['location_details'])){
				redirect();
				exit;
			}

			$location = $this->model('Location');
			if($location->hasLocationNoExpire($_SESSION['client']->id)){
				flash("youCantHireManyCars", "Vous ne pouvez pas louer plusieurs voitures en meme temps", "alert alert-danger");
				redirect('location/mesLocations');
				exit;
			}

			$location->date_depart = $_SESSION['location_details']['date_depart'].' '.$_SESSION['location_details']['heure_depart'];
			$location->date_retour = $_SESSION['location_details']['date_retour'].' '.$_SESSION['location_details']['heure_retour'];
			$location->prix = $_SESSION['location_details']['prix_total'];
			$location->matricule = $_SESSION['location_details']['matricule'];
			$location->client_id = $_SESSION['client']->id;
			$location->agence_depart = $_SESSION['location_details']['agence_depart'];
			$location->agence_retour = $_SESSION['location_details']['agence_retour'];
			$isCreated = $location->save();
			unset($_SESSION['location_details']);
			if($isCreated){
				return view('hiredWithSuccess');
			}
			return view('errorPage');

		}else{
			redirect();
			exit;
		}
	}

	public function mesLocations()
	{	
		return view('mesLocations');
	}

	public function getMesLocations()
	{
		$l = $this->model('Location');
		$locations = $l->find($_SESSION['client']->id);
		echo json_encode($locations);
	}

	private function calculDiffDate($date_retour, $date_depart) {
		$date_r = date_create($date_retour);
		$date_d = date_create($date_depart);

		return date_diff($date_r, $date_d)->days;
	}

	private function formatDate($dateString)
	{
		$date = date_create($dateString);
		return date_format($date, 'd/m/Y');
	}


}