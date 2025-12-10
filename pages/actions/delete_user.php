<?php

require_once '../../config.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $connexion -> query("DELETE FROM users WHERE id = '$id'");
    header('Location:../admin_pages/gestion_utilisateur.php');
    exit();
}


?>