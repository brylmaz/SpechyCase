<?php 

namespace App\model;

use App\Modal;
use App\Database;
use \PDO;

class Customer_package extends Modal {
	public $id;
	public $customer_id;
	public $package_id;
	

	function getAll(){
		$db = Database::getInstance();
		$query = $db->prepare("SELECT * FROM customer_package");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function addCustomerPackage() {
		if ($this->checkCustomerPackage()===true) {
			try {
				$db = Database::getInstance();
				$query = $db->prepare("INSERT INTO customer_package SET customer_id=?,package_id=?");
				$query->execute(array($this->customer_id,$this->package_id));
				$result=$query->fetchAll(PDO::FETCH_ASSOC);
				return $db->lastInsertId();
			} catch (Exception $e) {
				return false;
			}
			
		}
		else{
			$result=$this->checkCustomerPackage();
			return $result['package_id'];
		}
		
	}
	function checkCustomerPackage() {
		try {
			$db = Database::getInstance();
			$query = $db->prepare("SELECT * FROM customer_package WHERE customer_id = ? AND package_id= ?");
			$query->execute(array($this->customer_id,$this->package_id));
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

	function deleteCustomerPackage(){
		$db = Database::getInstance();
		$query = $db->prepare("DELETE FROM customer_package WHERE customer_id = ? AND package_id= ?");
		$query->execute(array($this->customer_id,$this->package_id));
		$query->fetch(PDO::FETCH_ASSOC);
		$result=$query->rowCount();
		return $result;
	}
	
}


?>