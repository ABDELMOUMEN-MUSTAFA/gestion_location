<?php

require_once 'Controller.php';

class LoginController extends Controller {

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
		return view('login');
	}

	private function validation($fields)
	{
		if(!preg_match("/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/", $fields['email'])){
			return false;
		}

		if(strlen($fields['mdp']) < 10){
			return false;
		}

		return true;
	}

	public function access()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			if(isset($_POST['email'], $_POST['mdp'])){
				$isValid = $this->validation($_POST);
				if(!$isValid){
					redirect('login');
					exit;
				}

				extract($_POST);
				$client = $this->model('Client');
				$client->email = $email;
				$client->mdp = $mdp;
				try {
					$client = $client->find();

					// create SESSION
					$_SESSION['client'] = $client;

					// redirect to search page
					redirect('car/recherche');
				} catch (Exception $e) {
					flash('loginFailed', $e->getMessage(), 'alert alert-danger');
					old('email', $email);
					old('mdp', $mdp);
					redirect('login');
					exit;
				}

			}else{
				redirect('login');
				exit;
			}
		}
	}
}