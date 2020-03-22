<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function autenticar() {
		echo "Autenticando";
		//$this->render('index');
	}

}


?>