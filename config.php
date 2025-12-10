<?php

$host = "localhost";
$user = "root";
$password = "";
$db_name = "db_auth";

$connexion = new mysqli($host,$user,$password,$db_name);

if ($connexion -> connect_error) {
    die('connect error :'.connexion -> connect_error);
}



?>