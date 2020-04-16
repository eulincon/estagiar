<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {
	private $id;
	private $email;
	private $senha;
	private $fk_tipo_usuario;
	
	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

	//salvar
	public function salvar($tipo_usuario){
		$query = "insert into tb_usuarios(email, senha, fk_tipo_usuario) values(:email, :senha, :tipo_usuario)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha')); //metodo md5 para crisptografia
		$stmt->bindValue(':tipo_usuario', $tipo_usuario);
		if(!$stmt->execute()){
			print_r($stmt->errorInfo());
		}else{
			return $this;
		}
	}

	public function validarCadastro(){
		$valido = true;

		/**if(strlen($this->__get('nome')) < 3){
			$valido = false;
		}
		if(strlen($this->__get('cpf')) < 14){
			$valido = false;
		}**/
		if(strlen($this->__get('email')) < 3){
			$valido = false;
		}
		if(strlen($this->__get('senha')) < 6){
			$valido = false;
		}

		return $valido;
	}

	public function getIdUsuarioPorEmail(){
		$query = "select id from tb_usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getIdPorEmail(){
		$query = "select id from tb_usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->email);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function autenticar(){
		$query = "select 
					id,
					email, 
					fk_tipo_usuario 
				from 
					tb_usuarios 
				where 
					email = :email and senha =:senha";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha'));
		
		$stmt->execute();
		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
		if($usuario['id'] != '' && $usuario['email'] != ''){
			$this->__set('id', $usuario['id']);
			$this->__set('email', $usuario['email']);
			$this->__set('fk_tipo_usuario', $usuario['fk_tipo_usuario']);
		}
		return $this;
	}

	public function getAll(){
		$query = "
			select 
				*
			from 
				tb_usuarios
			";
		$stmt = $this->db->prepare($query);
		
		if(!$stmt->execute()){
			echo "<br><br><br><br><br>";
			print_r($stmt->errorInfo());
		}

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}

?>