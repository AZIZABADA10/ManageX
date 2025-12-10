<?php

require_once '../../config.php';

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $res_select = $connexion -> query("SELECT * FROM users WHERE id = $id");
    
    $user = $res_select -> fetch_assoc();


if(isset($_POST['update_user_form_submit'])){
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];

    $connexion->query("UPDATE users SET `full_name` = '$full_name', `role` = '$role' WHERE id = $id");

    header('Location: ../admin_pages/gestion_utilisateur.php');
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user</title>
    <link rel="stylesheet" href="../style/update.css">
</head>
<body>
    <div class="container_form_add" id="add_user_form">
    <div class="form_info" id="add_user_form">
        <form action="update_user.php?id=<?= $user['id']; ?>" method="POST">
            <h3>Update user</h3>
            <input type="text" name="full_name" placeholder="Your full name" value="<?= $user['full_name']; ?>" required >
            <input type="email" name="email" placeholder="Your email" required value="<?= $user['email']; ?>"  readonly>
            <input type="password" name="password" placeholder="************" value="<?= $user['password']; ?>" readonly >
            <select name="role" id="role" required>
                <option value="">-- chose a role -- </option>
                <option value="admin"  <?= $user['role'] ==='admin'?'selected':''?> >admin</option>
                <option value="user" <?= $user['role'] === 'user'?"selected":'' ?>  >user</option>
            </select>      
            <button type="submit" style="background-color:green;" name="update_user_form_submit">Update</button>
            <button type="button" style="background-color:red;" onclick="window.location.href='../admin_pages/gestion_utilisateur.php'">Cancel</button>
        </form>
    </div>
        <script src="../js/script.js"></script>
</body>
</html>