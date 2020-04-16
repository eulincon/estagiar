<?php

namespace App\Models;

use MF\Model\Model;

class Aluno extends Model {
	private $id;
	private $fk_usuario;
	private $nome;
	private $telefone;
	private $cpf;
	private $cep;
	private $bairro;
	private $endereco;
	private $numero;
	private $idade;
	
	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}

	//salvar
	public function salvar($idUsuario){
		$query = "insert into tb_alunos(fk_usuario, nome, cpf) values (:fk_usuario, :nome, :cpf)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':cpf', $this->__get('cpf')); //metodo md5 para crisptografia
		$stmt->bindValue(':fk_usuario', $idUsuario[0]['id']);
		if(!$stmt->execute()){
			print_r($stmt->errorInfo());
		}else{
			return $this;
		}
	}

	public function getIdUsuarioPorEmail($email){
		$query = "select id from tb_usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $email);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getAlunoPorCpf(){
		$query = "select cpf from tb_alunos where cpf = :cpf";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':cpf', $this->__get('cpf'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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