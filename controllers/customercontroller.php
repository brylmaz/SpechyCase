<?php 
namespace App\controllers;

use App\Controller;
use App\model\Customer;

class CustomerController extends Controller {
	
  function __construct() {

  }
  

  public function Register(){

    $post = json_decode(file_get_contents('php://input'), true);

    if (!isset($post['name']) || !isset($post['lastname']) || !isset($post['email']) || !isset($post['password']) || !isset($post['phone'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen tüm parametlerini eksiksiz gönderiniz."
      ));
    }
    elseif (empty($post['name']) || empty($post['lastname']) || empty($post['email']) || empty($post['password']) || empty($post['phone'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen boş değer göndermeyiniz."
      ));
    }
    else{

      $name = htmlspecialchars($post['name']);
      $lastname = htmlspecialchars($post['lastname']);
      $email = htmlspecialchars($post['email']);
      $password = md5(htmlspecialchars($post['password']));
      $phone = htmlspecialchars($post['phone']);


      $CustomerObj = new Customer();
      $CustomerObj->name = $name;
      $CustomerObj->lastname = $lastname;
      $CustomerObj->email = $email;
      $CustomerObj->password = $password;
      $CustomerObj->phone = $phone;

      $CustomerResult = $CustomerObj->addCustomer();

      if ($CustomerResult==false) {
        response(array(
          "status" => false,
          "message" => "Hata"

        ));
      }
      else{
        response(array(
          "status" => true,
          "message" => "İşlem Başarıyla gerçekleşti",
          "customer_id" => $CustomerResult

        ));
      }
    }



  }

  public function Remove(){

    $post = json_decode(file_get_contents('php://input'), true);

    if (!isset($post['customer_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen customer_id parametlerisini eksiksiz gönderiniz."
      ));
    }
    elseif(empty($post['customer_id'])){
      response(array(
        "status" => false,
        "message" => "Lütfen customer_id parametlerisini boş göndermeyiniz."
      ));
    }
    else{
      $customer_id = htmlspecialchars($post['customer_id']);
      
      $CustomerObj = new Customer();
      $CustomerObj->customer_id = $customer_id;
      $CustomerResult = $CustomerObj->deleteCustomer();
      
      if ($CustomerResult==0) {
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

    $CustomerObj = new Customer();
    $CustomerResult = $CustomerObj->getAll();

    response(array(
      "status" => true,
      "message" => "İşlem başarıyla gerçekleşti",
      "Value" => $CustomerResult
    ));

  }
  public function Check(){
    $post = json_decode(file_get_contents('php://input'), true);

    if (!isset($post['customer_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen customer_id parametlerisini eksiksiz gönderiniz."
      ));
    }
    elseif(empty($post['customer_id'])){
      response(array(
        "status" => false,
        "message" => "Lütfen customer_id parametlerisini boş göndermeyiniz."
      ));
    }
    else{
      $customer_id = htmlspecialchars($post['customer_id']);
      
      $CustomerObj = new Customer();
      $CustomerObj->customer_id = $customer_id;
      $CustomerResult = $CustomerObj->getCustomerAll();

      response(array(
        "status" => true,
        "Value" => $CustomerResult
      ));
    }
  }
}


?>