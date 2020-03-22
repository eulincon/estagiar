<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function inscreverse(){
		$this->view->usuario = array(
			'nome' => '',
			'cpf' => '',
			'email' => '',
			'senha' => ''
		);
		$this->view->erroCadastro = false;
		$this->render('inscreverse');
	}

}


?>