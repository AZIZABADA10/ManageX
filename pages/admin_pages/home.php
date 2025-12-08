<?php

require_once '../../config.php';
require_once 'statistiques.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../../index.php');
    exit();
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../admin.css">
    <link rel="stylesheet" href="../style/statistique.css">
</head>
<body>
    <main>
        <header>
                <h1>Hello <span><?= $_SESSION['full_name']; ?> </span></h1>
               <p>Welcome to the <span>Dashboard</span> page</p>
                <button type="submit" onclick="window.location.href='../../logout.php'">Logout</button>
        </header>
        <aside>
            <nav>
                <ul>
                    <li style="background-color: rgb(137, 161, 182);"><a href="home.php">Dashboard</a></li>
                    <li><a href="gestion_utilisateur.php">Users Managment</a></li>
                    <li><a href="gestion_produit.php">Product managment</a></li>
                </ul>
            </nav>
        </aside>
        <article>
            <div class="stistique">               
                <div class="color_users">Users : <?= $nbr_users['nbr_users'] ?></div>
                <div class="color_admin">Admins : <?= $nbr_admin['nbr_admin'] ?></div>
                <div class="color_employees">Employees : <?= $nbr_employees['nbr_employees'] ?></div>
                <div class="color_Produits">Produits : <?= $nbr_produits['nbr_produits']; ?> </div>
                <div class="color_Disponible">Disponible : <?= $nbr_produits_disponible['nbr_produits_disponible'] ?></div>
                <div class="color_nonDisponible">Non Disponible : <?= $nbr_produits_nondisponible['nbr_produits_nondisponible'] ?></div>
            </div>
        </article>
    </main>
</body>
</html>