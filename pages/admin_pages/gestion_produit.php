<?php
require_once '../../config.php';
require_once 'statistiques.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../../index.php');
    exit();
}



$nom_produit_error = false;

if (isset($_POST['add_product_form_submit'])) {

    $nom_produit = $_POST['nom_produit'];
    $description_produit = $_POST['description_produit'];
    $prix_produit = $_POST['prix_produit'];
    $quantite_produit = $_POST['quantite_produit'];
    $categorie_produit = $_POST['categorie_produit'];
    $image_produit = $_POST['image_produit'];
    $statut_produit = $_POST['statut_produit'];

    $nom_produit_exist = $connexion -> query("SELECT nom_produit FROM produits WHERE nom_produit = '$nom_produit'");
    if ($nom_produit_exist -> num_rows > 0) {
        $nom_produit_error = true;
        $_SESSION['nom_produit_error'] = "Product name alredy exist !";
    }else{
        $connexion -> query("INSERT INTO produits 
        (`nom_produit`,`description_produit`,`prix_produit`,`quantite_produit`,`categorie_produit`,`image_produit`,`statut_produit`) 
        VALUES ('$nom_produit','$description_produit','$prix_produit','$quantite_produit','$categorie_produit','$image_produit','$statut_produit')");
        header('Location: gestion_produit.php');
        exit();
    }
    
}


$products = $connexion -> query("SELECT * FROM produits");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Managment</title>
    <link rel="stylesheet" href="../../admin.css">
    <link rel="stylesheet" href="../style/product_managmnet.css">
    <link rel="stylesheet" href="../style/statistique.css">
</head>
<body>
    <main>
        <header>
                <h1>Hello <span><?= $_SESSION['full_name']; ?> </span></h1>
                <p>Welcome to the <span>Product Managment</span> page</p>
                <button type="submit" onclick="window.location.href='../../logout.php'">Logout</button>
        </header>
        <aside>
            <nav>
                <ul>
                    <li><a href="home.php">Dashboard</a></li>
                    <li ><a href="gestion_utilisateur.php">Users Managment</a></li>
                    <li style="background-color: rgb(137, 161, 182);"><a href="gestion_produit.php">Product Managment</a></li>
                </ul>
            </nav>
        </aside>
        <article>
            <div class="stistique">               
                <div class="color_users">Produits : <?= $nbr_produits['nbr_produits']; ?> </div>
                <div class="color_admin">Disponible : <?= $nbr_produits_disponible['nbr_produits_disponible'] ?></div>
                <div class="color_employees">Non Disponible : <?= $nbr_produits_nondisponible['nbr_produits_nondisponible'] ?></div>
            </div>
            <div class="title_users_section">
                    <h2>Produits</h2> 
                    <button type="submit" name="add_product" onclick="show_form_add_user()">Add product</button>
            </div>
            <table border="1">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantite</th>
                    <th>Categorie</th>
                    <th>Date d'ajoute</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

            <?php while($produit = $products ->fetch_assoc()): ?>
                <tr>
                    <td><img src="<?= $produit['image_produit'] ?>" /></td>
                    <td><?= $produit['nom_produit'] ?></td>
                    <td><?= $produit['description_produit'] ?></td>
                    <td><?= $produit['prix_produit'] ?></td>
                    <td><?= $produit['quantite_produit'] ?></td>
                    <td><?= $produit['categorie_produit'] ?></td>
                    <td><?= $produit['date_ajout'] ?></td>
                    <td><?= $produit['statut_produit'] ?></td>
                    <td class="flex_button">
                        <a class="btn delete-btn" href="../actions/delete_product.php?delete=<?= $produit['id_produit'];?>"> Delete </a>
                        <a class="btn update-btn" href="../actions/update_product.php?id=<?= $produit['id_produit'];?>"> Update </a>
                    </td>
                </tr>
            <?php endwhile ?>
            </table>
        </article>
    </main>

    <div class="container_form_add" id="add_user_form">
    <div class="form_info" id="add_user_form">
        <form action="gestion_produit.php" method="POST">
            <h3>Add product</h3>
            <?php if ($nom_produit_error):?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            show_form_add_user(); 
                    });
                    </script>
                <?php endif;?>
                <?php if (isset($_SESSION['nom_produit_error'])): ?>
                    <p class="error_message"><?= $_SESSION['nom_produit_error'] ?></p>
                    <?php unset($_SESSION['nom_produit_error']); ?>
                <?php endif; ?>
            <input type="text" name="nom_produit" placeholder="Product name"  required>
            <textarea name="description_produit" placeholder="description product"></textarea>
            <input type="number" step="0.01" name="prix_produit" placeholder="99,99" required>
            <input type="number" name="quantite_produit" placeholder="99">
            <input type="text" name="categorie_produit" placeholder="categorie" required>
            <input type="text" name="image_produit" placeholder="image_produit" required>
            <select name="statut_produit" required>
                <option value="">-- chose a status -- </option>
                <option value="disponible" >Disponible</option>
                <option value="nondisponible">Non disponible</option>
            </select>      
            <button type="submit" style="background-color:green;" name="add_product_form_submit">Add</button>
            <button type="button" style="background-color:red;" onclick="hidde_form_add_user()">Cancel</button>
        </form>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>