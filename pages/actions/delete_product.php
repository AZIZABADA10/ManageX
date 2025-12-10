<?php

require_once '../../config.php';


if ($_GET['delete']) {
    $id = intval($_GET['delete']);
    $connexion -> query("DELETE FROM produits WHERE id_produit = $id");
    header('Location: ../admin_pages/gestion_produit.php');
    exit();
}



?>