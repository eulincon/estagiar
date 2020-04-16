<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function teste() {
		$this->render('teste');
	}

	public function index() {
		$this->view->erroCadastro = false;
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		$this->render('index');
	}

	public function inscreverseAluno(){
		$this->view->usuario = array(
			'nome' => '',
			'cpf' => '',
			'email' => '',
			'senha' => ''
		);
		$this->view->erroCadastro = false;
		$this->render('inscreverseAluno');
	}

	public function registrarAluno(){
		//receber os dados do formulario
		$usuario = Container::getModel('Usuario');
		$aluno = Container::getModel('Aluno');

		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		$aluno->__set('nome', $_POST['nome']);
		$aluno->__set('cpf', $_POST['cpf']);

		if(
			$usuario->validarCadastro() && 
			count($usuario->getIdUsuarioPorEmail()) == 0 && 
			count($aluno->getAlunoPorCpf()) == 0){
	
			if($usuario->salvar(1) && $aluno->salvar($usuario->getIdUsuarioPorEmail())){
				header('Location: /');
			}
			print_r($usuario->getIdUsuarioPorEmail());

		}else{
			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'cpf' => $_POST['cpf'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha']
			);
			$this->view->erroCadastro = true;
			$this->render('inscreverseAluno');
		}
	}

}


?>