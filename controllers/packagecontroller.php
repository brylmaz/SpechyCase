<?php 
namespace App\controllers;

use App\Controller;
use App\model\Customer_package;
use App\model\Package;
use App\model\Customer;

class PackageController extends Controller {
	
  function __construct() {

  }
  

  public function Add(){

    $post = json_decode(file_get_contents('php://input'), true);

    if (!isset($post['package_id']) || !isset($post['customer_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen tüm parametlerini eksiksiz gönderiniz."
      ));
    }
    elseif (empty($post['package_id']) || empty($post['customer_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen boş değer göndermeyiniz."
      ));
    }
    else{

      $package_id = htmlspecialchars($post['package_id']);
      $customer_id = htmlspecialchars($post['customer_id']);
      
      $CustomerObj = new Customer();
      $CustomerObj->customer_id= $customer_id;
      $CustomerObjResult = $CustomerObj->getCustomerById();

      if ($CustomerObjResult===true) {
        response(array(
          "status" => false,
          "message" => "Böyle Bir kullanıcı bulunamadı"

        ));
        exit;
      }

      $PackageObj = new Package();
      $PackageObj->package_id=$package_id;
      $packageObjResult = $PackageObj->checkPackage();

      if ($packageObjResult===true) {
        response(array(
          "status" => false,
          "message" => "Böyle Bir Paket bulunamadı"

        ));
        exit;
      }

      $customerpackageObj = new Customer_package();
      $customerpackageObj->customer_id = $customer_id;
      $customerpackageObj->package_id = $package_id;
      $customerpackageResult = $customerpackageObj->addCustomerPackage();
     

      if ($customerpackageResult==false) {
        response(array(
          "status" => false,
          "message" => "Hata"

        ));
      }
      else{
        response(array(
          "status" => true,
          "message" => "İşlem Başarıyla gerçekleşti",
          "customer_id" => $customerpackageResult

        ));
      }
    }



  }

  public function Remove(){

    $post = json_decode(file_get_contents('php://input'), true);

    if (!isset($post['package_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen package_id parametlerisini eksiksiz gönderiniz."
      ));
    }
    elseif(empty($post['package_id'])){
      response(array(
        "status" => false,
        "message" => "Lütfen package_id parametlerisini boş göndermeyiniz."
      ));
    }
    else{
      $package_id = htmlspecialchars($post['package_id']);
      $customer_id = htmlspecialchars($post['customer_id']);
      
      $CustomerObj = new Customer();
      $CustomerObj->customer_id= $customer_id;
      $CustomerObjResult = $CustomerObj->getCustomerById();

      if ($CustomerObjResult===true) {
        response(array(
          "status" => false,
          "message" => "Böyle Bir kullanıcı bulunamadı"

        ));
        exit;
      }

      $PackageObj = new Package();
      $PackageObj->package_id=$package_id;
      $packageObjResult = $PackageObj->checkPackage();

      if ($packageObjResult===true) {
        response(array(
          "status" => false,
          "message" => "Böyle Bir Paket bulunamadı"

        ));
        exit;
      }
      
      $customerpackageObj = new Customer_package();
      $customerpackageObj->package_id = $package_id;
      $customerpackageObj->customer_id = $customer_id;
      $customerpackageObjResult = $customerpackageObj->deleteCustomerPackage();

      if ($customerpackageObjResult==0) {
        response(array(
        "status" => false,
        "message" => "Silme İşlemi gerçekleşmedi veya belirtilen kayıt bulunamadı."
      ));
      }
      else{
        response(array(
        "status" => true,
        "message" => "Başarıyla silindi"
      ));
      }
    }
  }

  public function List(){

    $customerpackageObj = new Customer_package();
    $customerpackageObjResult = $customerpackageObj->getAll();

    response(array(
        "status" => true,
        "message" => "İşlem başarıyla gerçekleşti",
        "Value" => $customerpackageObjResult
      ));

  }
}


?>