<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/database.php';
require __DIR__ . '/helper.php';
require __DIR__ . '/Modal.php';
require __DIR__ . '/controller.php';
require __DIR__ . '/route.php';

 



// Route::run('/getLayout', 'spiralcontroller@getLayout','post');
// Route::run('/getValueOfLayout', 'spiralcontroller@getValueOfLayout','post');

//Customer
Route::run('/Customer/Register', 'customercontroller@Register','post');
Route::run('/Customer/Remove', 'customercontroller@Remove','post');
Route::run('/Customer/List', 'customercontroller@List','post');
Route::run('/Customer/Check', 'customercontroller@Check','post');

//Company
Route::run('/Company/Add', 'companycontroller@Add','post');
Route::run('/Company/Remove', 'companycontroller@Remove','post');
Route::run('/Company/List', 'companycontroller@List','post');

//Package
Route::run('/Package/Add', 'packagecontroller@Add','post');
Route::run('/Package/Remove', 'packagecontroller@Remove','post');
Route::run('/Package/List', 'packagecontroller@List','post');

