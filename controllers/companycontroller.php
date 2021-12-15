<?php 
namespace App\controllers;

use App\Controller;
use App\model\Company;
use App\model\Customer;

class CompanyController extends Controller {
	
  function __construct() {

  }
  

  public function Add(){

    $post = json_decode(file_get_contents('php://input'), true);

    if (!isset($post['name']) || !isset($post['email']) || !isset($post['phone']) || !isset($post['tax_no']) || !isset($post['tax_circle']) || !isset($post['customer_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen tüm parametlerini eksiksiz gönderiniz."
      ));
    }
    elseif (empty($post['name']) || empty($post['email']) || empty($post['phone']) || empty($post['tax_no']) || empty($post['tax_circle']) || empty($post['customer_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen boş değer göndermeyiniz."
      ));
    }
    else{

      $name = htmlspecialchars($post['name']);
      $email = htmlspecialchars($post['email']);
      $phone = htmlspecialchars($post['phone']);
      $tax_no = htmlspecialchars($post['tax_no']);
      $tax_circle = htmlspecialchars($post['tax_circle']);
      $customer_id = htmlspecialchars($post['customer_id']);


      $CompanyObj = new Company();
      $CompanyObj->customer_id = $customer_id;
      $CompanyObj->name = $name;
      $CompanyObj->email = $email;
      $CompanyObj->phone = $phone;
      $CompanyObj->tax_no = $tax_no;
      $CompanyObj->tax_circle = $tax_circle;
      $CompanyObjResult = $CompanyObj->addCompany();

     

      if ($CompanyObjResult==false) {
        response(array(
          "status" => false,
          "message" => "Hata"

        ));
      }
      else{
        response(array(
          "status" => true,
          "message" => "İşlem Başarıyla gerçekleşti",
          "customer_id" => $CompanyObjResult

        ));
      }
    }



  }

  public function Remove(){

    $post = json_decode(file_get_contents('php://input'), true);

    if (!isset($post['company_id'])) {
      response(array(
        "status" => false,
        "message" => "Lütfen company_id parametlerisini eksiksiz gönderiniz."
      ));
    }
    elseif(empty($post['company_id'])){
      response(array(
        "status" => false,
        "message" => "Lütfen company_id parametlerisini boş göndermeyiniz."
      ));
    }
    else{
      $company_id = htmlspecialchars($post['company_id']);
      
      $CompanyObj = new Company();
      $CompanyObj->company_id = $company_id;
      $CompanyObjResult = $CompanyObj->deleteCompany();

      if ($CompanyObjResult==0) {
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

    $CompanyObj = new Company();
    $CompanyObjResult = $CompanyObj->getAll();

    response(array(
        "status" => true,
        "message" => "İşlem başarıyla gerçekleşti",
        "Value" => $CompanyObjResult
      ));

  }
}


?>