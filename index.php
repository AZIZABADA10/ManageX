<?php

require_once 'config.php';


if (isset($_POST['btn_search'])) {
    $title = $_POST['name_search'];
    $stmt = $connexion->prepare("SELECT * FROM produits WHERE nom_produit LIKE ?");
    $stmt->bind_param("s", $search);
    $search = "%".$title."%";
    $stmt->execute();
    $products = $stmt->get_result();
} else {
    $products = $connexion->query("SELECT * FROM produits");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanoute</title>
    <link rel="stylesheet" href="assets/css/style_accuiel.css">
</head>

<body>
    <header class="header">
        <div>
            <img src="assets/images/jira.png" alt="logo">
            <h1>HANOUTE</h1>
        </div>
        <div>
            
            <form action="index.php" method="POST">
                <input type="search" name="name_search"  placeholder="Search Product">
                <button type="submit" name="btn_search" class="btn_search">Search</button>
            </form>
            <button type="button" class="btn_login" onclick="window.location.href='authentification.php'">Login</button>
        </div>
    </header>
    <main>
        <section>
            <div class="carousel">
                <div class="slides">
                    <img src="assets/images/pexels-madebymath-90946.jpg" alt="image1" class="slide active">
                    <img src="assets/images/pexels-pixabay-4158.jpg" alt="image2" class="slide ">
                    <img src="assets/images/pexels-pixabay-279906.jpg" alt="image3" class="slide ">
                </div>
                <button id="prev">◀</button>
                <button id="next">▶</button>
            </div>
        </section>
                <section class="section_produits">
            <h1>Nos Products</h1>
            <div class="produits">
                <?php while ($product = $products->fetch_assoc()): ?>
                    <div class="product_card">
                        <img src="assets/<?= $product['image_produit'] ?>">
                        <div class="flex">
                            <h3><?= $product['nom_produit'] ?></h3>
                            <p><span><?= $product['prix_produit'] ?> DH </span></p>
                        </div>
                        <div class="flex">
                            <p>Quantite: <?= $product['quantite_produit'] == 0 ?'plus tard':$product['quantite_produit'] ?></p>
                            <p><?= $product['statut_produit']==='disponible'?'Disponible':'Non Disponible' ?></p>
                        </div>
                        <div class="flex">
                            <button type="button" class="btn_search">buy now</button>
                            <button type="button" class="btn_login" onclick="window.location.href='authentification.php'">Show Info</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
        <section class="section_entreprise">
            <h1>About us</h1>
            <div class="entreprise">
                <img class="desc_hanoute" src="assets/images/jira.png">
                <div class="desc_hanoute">
                    <h2>HANOUTE</h2>
                    <p>Votre plateforme pour acheter les meilleurs produits<br>
                        Lorem ipsum dolor sit amet consectetur, adipisicing.<br>
                        Nostrum laboriosam consequuntur doloribus odio qui.<br>
                        Do Loremque odio neque optio accusamus aliquid omnis,<br>
                        magni exercitationem eaque non est, illum dignissimos?<br>
                        Lorem ipsum dolor sit consectetur, adipisicingddddd.<br>
                        Nostrum laboriosam consequuntur doloribus odio qui.<br>
                        Do Loremque odio neque optio accusamus aliquid omnis,<br>
                        Do Loremque odio neque optio accusamus aliquid omnis,<br>
                        magni exercitationem eaque non est, illum dignissimos?<br>
                        Lorem ipsum dolor sit consectetur, dddddadipisicing.<br>
                        Nostrum laboriosam consequuntur doloribus odio qui.<br>
                        Do Loremque odio neque optio accusamus aliquid omnis,<br>
                        magni exercitationem eaque non est, illum dignissimos?
                    </p>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer-container">

            <div class="footer-section">
                <h3>HANOUTE</h3>
                <p>Votre plateforme pour acheter les meilleurs produits.</p>
            </div>

            <div class="footer-section">
                <h3>Liens rapides</h3>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Produits</a></li>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email : Abadaaziz@gmail.com</p>
                <p>Téléphone : +212 6 11 11 22 00</p>
            </div>

        </div>
        <div class="footer-bottom">
            <p>© 2025 HANOUTE — Tous droits réservés.</p>
        </div>
    </footer>
    <script src="assets/js/carousel.js"></script>
</body>

</html>