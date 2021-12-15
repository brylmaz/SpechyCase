<?php 

namespace App\model;

use App\Modal;
use App\Database;
use \PDO;

class Package extends Modal {
	public $package_id;
	

	
	function checkPackage() {
		$db = Database::getInstance();
		$query = $db->prepare("SELECT * FROM package WHERE package_id = ? ");
		$query->execute(array($this->package_id));
		$result=$query->fetch(PDO::FETCH_ASSOC);
		if (empty($result)) {
			return true;
		}
		else{
			return $result;
		}
	}
}


?>