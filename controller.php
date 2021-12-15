<?php

namespace App;


class Controller
{
    function __construct() {


    }

    public function view($name, $data = [])
    {
        extract($data);
        require __DIR__ . '/view/static/header.php';
        require __DIR__ . '/view/' . strtolower($name) . '.php';
        require __DIR__ . '/view/static/footer.php';
    }

   

    

   

}
