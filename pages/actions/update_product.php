<?php

require_once '../../config.php';

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $res_select = $connexion -> query("SELECT * FROM produits WHERE id_produit = $id");
    
    $produit = $res_select -> fetch_assoc();


if(isset($_POST['update_product_form_submit'])){

    $nom_produit = $_POST['nom_produit'];
    $description_produit = $_POST['description_produit'];
    $prix_produit = $_POST['prix_produit'];
    $quantite_produit = $_POST['quantite_produit'];
    $categorie_produit = $_POST['categorie_produit'];
    $image_produit = $_POST['image_produit'];
    $statut_produit = $_POST['statut_produit'];

        $connexion -> query("UPDATE produits 
        SET `nom_produit` = '$nom_produit', `description_produit` = '$description_produit', `prix_produit` = $prix_produit,
         `quantite_produit` = $quantite_produit, `categorie_produit` = '$categorie_produit', `image_produit` = '$image_produit',
         `statut_produit` = '$statut_produit'
         WHERE id_produit = $id");
        header('Location: ../admin_pages/gestion_produit.php');
        exit();
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="../style/update_product.css">
</head>
<body>
    <div class="container_form_add" id="add_user_form">
    <div class="form_info" id="add_user_form">
        <form action="update_product.php?id=<?= $produit['id_produit'] ?>" method="POST">
            <h3>Update product</h3>
            <input type="text" name="nom_produit" placeholder="Product name"  value="<?= $produit['nom_produit'] ?>" required>
            <textarea name="description_produit" placeholder="description product"><?= $produit['description_produit'] ?></textarea>
            <input type="number" step="0.01" name="prix_produit" placeholder="99,99" value="<?= $produit['prix_produit'] ?>" required>
            <input type="number" name="quantite_produit" placeholder="99" require value="<?= $produit['quantite_produit'] ?>" required>
            <input type="text" name="categorie_produit" placeholder="categorie" required value="<?= $produit['categorie_produit'] ?>" required>
            <input type="text" name="image_produit" placeholder="image_produit" required value="<?= $produit['nom_produit'] ?>" required>
            <select name="statut_produit" required>
                <option value="">-- chose a status -- </option>
                <option value="disponible" <?= $produit['statut_produit'] === 'disponible' ? 'selected':'' ?> >Disponible</option>
                <option value="nondisponible" <?= $produit['statut_produit'] === 'nondisponible' ? 'selected':'' ?>>Non disponible</option>
            </select>      
            <button type="submit" style="background-color:green;" name="update_product_form_submit">update</button>
            <button type="button" style="background-color:red;" onclick="window.location.href='../admin_pages/gestion_produit.php'">Cancel</button>
        </form>
    </div>
        <script src="../js/script.js"></script>
</body>
</html>