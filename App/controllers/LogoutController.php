<?php

require_once 'Controller.php';

class LogoutController extends Controller {
	public function __construct()
	{
		session_destroy();
		redirect();
	}
}