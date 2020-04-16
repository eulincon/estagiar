<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function autenticar() {
		$usuario = Container::getModel('Usuario');
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['pwd']));
		$usuario->autenticar();
		if($usuario->__get('id') != '' && $usuario->__get('email') != ''){
			session_start();
			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['email'] = $usuario->__get('email');
			$_SESSION['tipo_usuario'] = $usuario->fk_tipo_usuario;
			if($usuario->__get('fk_tipo_usuario') == 1){
				//echo "Login efetuado com sucesso, pagina do aluno";
				header('Location: /timeline');
			}
		}else{
				//echo "erro login";
				header('Location: /?login=erro');
			}

	}
	public function autenticar2(){
		print_r($_POST);
		echo "estou aaqui";
	}
}


?>