<?php 

namespace App\model;

use App\Modal;
use App\Database;
use \PDO;

class Customer extends Modal {
	public $customer_id;
	public $name;
	public $lastname;
	public $email;
	public $password;
	public $phone;

	function getAll(){
		$db = Database::getInstance();
		$query = $db->prepare("SELECT * FROM customer");
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	function getCustomerAll(){
		$db = Database::getInstance();
		$query = $db->prepare("SELECT 
			customer.customer_id as customer_id,
			customer.name as customer_name,
			customer.lastname as customer_lastname,
			customer.email as customer_email,
			customer.phone as customer_phone,
			company.company_id as company_id,
			company.name as company_name,
			company.email as company_email,
			company.phone as company_phone,
			company.tax_no as company_tax_no,
			company.tax_circle as company_tax_circle,
			package.name as package_name,
			payment.name as payment_name
			FROM `customer` 
			INNER JOIN company ON customer.customer_id=company.customer_id
			INNER JOIN customer_package ON customer.customer_id=customer_package.customer_id 
			INNER JOIN package ON package.package_id=customer_package.package_id
			INNER JOIN customer_payment ON customer_payment.customer_id=customer.customer_id
			INNER JOIN payment ON payment.payment_id=customer_package.package_id
			WHERE customer.customer_id=?;");
		$query->execute(array($this->customer_id));
		$result=$query->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}

	function getCustomerById() {
		try {
			$db = Database::getInstance();
			$query = $db->prepare("SELECT * FROM customer WHERE customer_id=?");
			$query->execute(array($this->customer_id));
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
	
	function addCustomer() {
		
		if ($this->checkCustomer()===true) {
			try {
				$db = Database::getInstance();
				$query = $db->prepare("INSERT INTO customer SET name=?,lastname=?,email=?,password=?,phone=?");
				$query->execute(array($this->name,$this->lastname,$this->email,$this->password,$this->phone));
				$result=$query->fetchAll(PDO::FETCH_ASSOC);
				return $db->lastInsertId();
			} catch (Exception $e) {
				return false;
			}
			
		}
		else{
			$result=$this->checkCustomer();
			return $result['customer_id'];

		}
		
	}
	function checkCustomer() {
		try {
			$db = Database::getInstance();
			$query = $db->prepare("SELECT * FROM customer WHERE email = ? AND phone= ?");
			$query->execute(array($this->email,$this->phone));
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

	function deleteCustomer(){
		$db = Database::getInstance();
		$query = $db->prepare("DELETE FROM customer WHERE customer_id = ? ");
		$query->execute(array($this->customer_id));
		$query->fetch(PDO::FETCH_ASSOC);
		$result=$query->rowCount();

		return $result;
	}
	
}


?>