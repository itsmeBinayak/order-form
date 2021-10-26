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
    // session_destroy();
}

foreach ($products AS $i => $product){
if(isset($_POST['products'][$i])){
    $totalValue = $totalValue + $product['price'];
    $_SESSION['totalvalue'] = $totalValue;
}
}
// define variables and set to empty values
$emailErr = $streetNameErr = $streetNumberErr = $cityNameErr = $zipCodeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
  else{
    $_SESSION["email"] = $_POST["email"];
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }  
  }
   
  if (empty($_POST["street"])) {
    $streetNameErr = "street name is required";
  } 
  else{
    $_SESSION["street"] = $_POST["street"];
    $streetName = test_input($_POST["street"]);
    // check if street name is well-formed
    if (!preg_match("/^[a-zA-Z-' ]*$/",$streetName)) {
      $streetNameErr = "Invalid street name.";
    }
}
  if (empty($_POST["streetnumber"])) {
    $streetNumberErr = "street number is required";
  } 
  else{
    $_SESSION["streetnumber"] = $_POST["streetnumber"];
    $streetNumber = test_input($_POST["streetnumber"]);
    // check if street number is well-formed
    if (!preg_match("/^[\d]+$/",$streetNumber)) {
      $streetNumberErr = "Invalid street number.";
    }
}
  if (empty($_POST["city"])) {
    $cityNameErr = "city name is required";
  } 
  else{
    $_SESSION["city"] = $_POST["city"];
    $cityName = test_input($_POST["city"]);
    // check if city name is well-formed
    if (!preg_match("/^[a-zA-Z-' ]*$/",$cityName)) {
      $cityNameErr = "Invalid city name.";
    }
}
  if (empty($_POST["zipcode"])) {
    $zipCodeErr = "zip code is required";
  } 
  else{
    $_SESSION["zipcode"] = $_POST["zipcode"];
    $zipCode = test_input($_POST["zipcode"]);
    // check if zipcode is well-formed
    if (!preg_match("/^[\d]+$/",$zipCode)) {
      $zipCodeErr = "Invalid zipcode.";
    }
}
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

require 'form-view.php';

