<?php
require_once '../../config.php';


$nbr_admin_sql = $connexion -> query("SELECT COUNT(*) as nbr_admin from users WHERE `role` = 'admin'");
$nbr_admin = $nbr_admin_sql-> fetch_assoc();

$nbr_users_sql = $connexion -> query("SELECT COUNT(*) as nbr_users from users");
$nbr_users = $nbr_users_sql-> fetch_assoc();

$nbr_employees_sql = $connexion -> query("SELECT COUNT(*) as nbr_employees from users WHERE `role` = 'user'");
$nbr_employees = $nbr_employees_sql-> fetch_assoc();

$users_sql = $connexion -> query("SELECT * FROM users");


$produit_sql = $connexion -> query("SELECT count(*) as nbr_produits FROM produits");
$nbr_produits = $produit_sql -> fetch_assoc();


$nbr_produits_disponible_sql = $connexion -> query("SELECT count(*) as nbr_produits_disponible FROM produits where statut_produit = 'disponible'");
$nbr_produits_disponible = $nbr_produits_disponible_sql -> fetch_assoc();

$nbr_produits_nondisponible_sql = $connexion -> query("SELECT count(*) as nbr_produits_nondisponible FROM produits where statut_produit = 'nondisponible'");
$nbr_produits_nondisponible = $nbr_produits_nondisponible_sql -> fetch_assoc();

?>