<?php 

require 'database/db.php';

class Employee {
	
	private $db;
	
	public function __construct(){
		$this->db = DBCxn::get();
	}
	
	public function deleteEmployee(){
		$st = $this->db->prepare("DELETE FROM employees WHERE id=:id");
		$st->bindParam(":id", $_POST['id']);
		return $st->execute();
	}
	
	public function updateEmployee(){
		$st = $this->db->prepare("UPDATE employees SET name=:name, email=:email, contact_number=:contact, position=:position WHERE id=:id");
		$st->bindParam(":name", $_POST['name']);
		$st->bindParam(":email", $_POST['email']);
		$st->bindParam(":contact", $_POST['contact']);
		$st->bindParam(":position", $_POST['position']);
		$st->bindParam(":id", $_POST['id'], PDO::PARAM_INT);
		return $st->execute();
	}
	
	public function fetchAllEmployee(){
		$st = $this->db->query('SELECT * FROM employees');
		return $st->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function fetchByEmployeeId(){
		$st = $this->db->prepare("SELECT * FROM employees WHERE id=:id");
		$st->bindParam(":id", $_POST["id"]);
		$st->execute();
		return $st->fetch(PDO::FETCH_ASSOC);
	}
	
	public function addEmployee(){
		try{
			$st = $this->db->prepare("INSERT INTO employees(name,email,contact_number,position) VALUES (:name, :email, :contact_number, :position)");
			$st->bindParam(":name",$_POST['name']);
			$st->bindParam(":email",$_POST['email']);
			$st->bindParam(":contact_number",$_POST['contact']);
			$st->bindParam(":position",$_POST['position']);
			return $st->execute();
		}
		catch(PDOException $e){
			$success = false;
			throw $e;
		}
	}
}
