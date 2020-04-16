<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action{

	public function timeline(){

		session_start();

		//$this->validaAutenticacao();

		$this->view->id = $_SESSION['id'];
		$this->view->email = $_SESSION['email'];
		$this->view->tipo_usuario = $_SESSION['tipo_usuario'];

		$this->render('timeline');
	}

	public function curriculo(){

		session_start();

		//$this->validaAutenticacao();

		$this->view->id = $_SESSION['id'];
		$this->view->email = $_SESSION['email'];
		$this->view->tipo_usuario = $_SESSION['tipo_usuario'];

		$this->render('curriculo');
	}


	public function validaAutenticacao(){

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
			header('Location: /?login=erro');
		}
	}
	
}