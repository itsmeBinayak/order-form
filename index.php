<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions

session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$sandwichs = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;


$valueChange = 0;

if(isset($_GET['food'])){
    $valueChange = $_GET['food'];
}
if(!$valueChange){
    $products = $drinks;
}
else{
    $products = $sandwichs;
}

// define variables and set to empty values
$emailErr = $streetNameErr = $streetNumberErr = $cityNameErr = $zipCodeErr = "";

//  $streetName = $_POST["email"];
//  $streetNumber = $_POST["email"];
//  $cityName = $_POST["email"];
//  $zipCode = $_POST["email"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
  else{
    $_SESSION["email"] = $_POST["email"];
    $email = $_POST["email"];
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  if (empty($_POST["street"])) {
    $streetNameErr = "street name is required";
  } 
  if (empty($_POST["streetnumber"])) {
    $streetNumberErr = "street number is required";
  } 
  if (empty($_POST["city"])) {
    $cityNameErr = "city name is required";
  } 
  if (empty($_POST["zipcode"])) {
    $zipCodeErr = "zip code is required";
  } 
}


require 'form-view.php';
session_destroy();