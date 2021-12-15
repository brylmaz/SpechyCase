<?php 

namespace App\model;

use App\Modal;
use App\Database;
use \PDO;


class Company extends Modal {
	public $company_id;
	public $customer_id;
	public $name;
	public $email;
	public $phone;
	public $tax_no;
	public $tax_circle;

	function getAll(){
		$db = Database::getInstance();
		$query = $db->prepare("SELECT * FROM company");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function addCompany() {
		if ($this->checkCompany()===true) {
			try {
				$db = Database::getInstance();
				$query = $db->prepare("INSERT INTO company SET customer_id=?,name=?,email=?,phone=?,tax_no=?,tax_circle=?");
				$query->execute(array($this->customer_id,$this->name,$this->email,$this->phone,$this->tax_no,$this->tax_circle));
				$result=$query->fetchAll(PDO::FETCH_ASSOC);
				return $db->lastInsertId();
			} catch (Exception $e) {
				return false;
			}
			
		}
		else{
			$result=$this->checkCompany();
			return $result['company_id'];
		}
		
	}
	function checkCompany() {
		try {
			$db = Database::getInstance();
			$query = $db->prepare("SELECT * FROM company WHERE email = ? AND name= ? AND phone=?");
			$query->execute(array($this->email,$this->name,$this->phone));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			if (empty($result)) {
				return true;
			}
			else{
				return $result;
			}
		} catch (Exception $e) {
			return false;
		}
		
	}

	function deleteCompany(){
		$db = Database::getInstance();
		$query = $db->prepare("DELETE FROM company WHERE company_id = ? ");
		$query->execute(array($this->company_id));
		$query->fetch(PDO::FETCH_ASSOC);
		$result=$query->rowCount();
		return $result;
		
	}
	
}


?>