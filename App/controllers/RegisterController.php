<?php

require_once 'Controller.php';

class RegisterController extends Controller {

	function __construct()
	{
		if(isset($_SESSION['client'])){
			// redirect to Home Page
			redirect();
			exit;
		}
	}

	public function index()
	{
		return view('register');
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

		if(strlen($fields['mdp1']) < 10){
			return false;
		}

		if($fields['mdp1'] !== $fields['mdp2']){
			return false;
		}

		return true;
	}

	public function create()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			if(isset($_POST['nom'], $_POST['prenom'], $_POST['cin'], $_POST['telephone'], $_POST['ville'], $_POST['province'], $_POST['rue'], $_POST['code_postal'], $_POST['email'], $_POST['mdp1'], $_POST['mdp2'])){
				$isValid = $this->validation($_POST);
				if(!$isValid){
					redirect('register');
					exit;
				}

				extract($_POST);
				// Insert Client Address
				$newAdresse = $this->model('Adresse');
				$newAdresse->ville = htmlspecialchars($ville);
				$newAdresse->rue = htmlspecialchars($rue);
				$newAdresse->province = htmlspecialchars($province);
				$newAdresse->code_postal = htmlspecialchars($code_postal);
				$adresse_id = $newAdresse->save();

				// Insert Client
				$newClient = $this->model('Client');
				$newClient->nom = htmlspecialchars($nom);
				$newClient->prenom = htmlspecialchars($prenom);
				$newClient->cin = htmlspecialchars($cin);
				$newClient->telephone = htmlspecialchars($telephone);
				$newClient->email = htmlspecialchars($email);
				$newClient->adresse_id = $adresse_id;
				$newClient->hashPassword($mdp1);
				$newClient->save();

				flash("loginSuccess", "inscription a été effectué avec succès");
				redirect('Login');

			}else{
				redirect('register');
				exit;
			}

		}
		
	}
}