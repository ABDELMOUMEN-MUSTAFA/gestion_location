<?php

require_once 'Controller.php';

class ClientController extends Controller {
	function __construct(){
		if(!isset($_SESSION['client'])){
			// redirect to Login Page
			redirect('login');
			exit;
		}
	}

	public function profil()
	{
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			$clientModel = $this->model('Client');
			$client = $clientModel->findByEmail($_SESSION['client']->email);
			return view('profil', ['client' => $client]);
		}


		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			if(isset($_POST['nom'], $_POST['prenom'], $_POST['cin'], $_POST['telephone'], $_POST['ville'], $_POST['province'], $_POST['rue'], $_POST['code_postal'], $_POST['email'])){
				$isValid = $this->validation($_POST);
				if(!$isValid){
					redirect('client/profil');
					exit;
				}

				extract($_POST);
				// Insert Client Address
				$adresse = $this->model('Adresse');
				$adresse->ville = htmlspecialchars($ville);
				$adresse->rue = htmlspecialchars($rue);
				$adresse->province = htmlspecialchars($province);
				$adresse->code_postal = htmlspecialchars($code_postal);
				$adresse->edit($_SESSION['client']->adresse_id); 

				// Insert Client
				$client = $this->model('Client');
				$client->nom = htmlspecialchars($nom);
				$client->prenom = htmlspecialchars($prenom);
				$client->cin = htmlspecialchars($cin);
				$client->telephone = htmlspecialchars($telephone);
				$client->email = htmlspecialchars($email);
				$client->adresse_id = $_SESSION['client']->adresse_id;
				$client->edit($_SESSION['client']->id);

				flash("editSuccess", "votre information a été modifier avec success");
				redirect('client/profil');
			}else{
				redirect('client/profil');
				exit;
			}
		}
	}

	private function validation($fields)
	{
		if(!preg_match("/^[a-zéA-Z]{3,20}$/", $fields['nom'])){
			return false;
		}

		if(!preg_match("/^[a-zéA-Z]{3,20}$/", $fields['prenom'])){
			return false;
		}

		if(!preg_match("/^[a-zA-Z0-9]{6,15}$/", $fields['cin'])){
			return false;
		}

		if(!preg_match("/^[a-zéA-Z]{3,20}$/", $fields['ville'])){
			return false;
		}

		if(!preg_match("/^[a-zéA-Z]{3,20}$/", $fields['province'])){
			return false;
		}

		if(!preg_match("/^[a-z A-Zé,0-9]{7,100}$/", $fields['rue'])){
			return false;
		}

		if(!preg_match("/^[1-9][0-9]{4}$/", $fields['code_postal'])){
			return false;
		}

		if(!preg_match("/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/", $fields['email'])){
			return false;
		}

		return true;
	}
}