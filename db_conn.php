<?php 
//initialisatie

define("DB_SERVER","localhost");
define("DB_USER","dekeselr");
define("DB_PASS","jBsgC3M2");
define("DB_NAME", "dekeselr");


//stap 1: connecteren met de database
if(!$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)){
	echo "Er kan geen verbinding gemaakt worden met de DB";
	exit;
}


//charset initialiseren naar UTF-8
mysqli_set_charset($db, "utf8");
setlocale (LC_ALL, "nl_NL");

?>