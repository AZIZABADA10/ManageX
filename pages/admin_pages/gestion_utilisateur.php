<?php

require_once '../../config.php';
require_once 'statistiques.php';

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: ../../index.php');
    exit();
}





$email_error = false;

if (isset($_POST['add_user_form_submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

    $email_exist = $connexion -> query("SELECT email FROM users WHERE email = '$email'");
    if ($email_exist -> num_rows > 0) {
        $email_error = true;
        $_SESSION['add_user_error'] = "email alredy exist !";
    }else{
        $connexion -> query("INSERT INTO users 
        (`full_name`,`email`,`password`,`role`) 
        VALUES 
        ('$full_name','$email','$password','$role');");
        header('Location:gestion_utilisateur.php');
        exit();
    }
    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Managment</title>
    <link rel="stylesheet" href="../../admin.css">
    <link rel="stylesheet" href="../style/users_managment.css">
    <link rel="stylesheet" href="../style/statistique.css">
</head>
<body>
    <main>
        <header>
                <h1>Hello <span><?= $_SESSION['full_name']; ?> </span></h1>
                <p>Welcome to the <span>Users Managment</span> page</p>
                <button type="submit" onclick="window.location.href='../../logout.php'">Logout</button>
        </header>
        <aside>
            <nav>
                <ul>
                    <li><a href="home.php">Dashboard</a></li>
                    <li style="background-color: rgb(137, 161, 182);"><a href="gestion_utilisateur.php">Users Managment</a></li>
                    <li><a href="gestion_produit.php">Product Managment</a></li>
                </ul>
            </nav>
        </aside>
        <article>
            <div class="stistique">               
                <div class="color_users">Users : <?= $nbr_users['nbr_users'] ?></div>
                <div class="color_admin">Admins : <?= $nbr_admin['nbr_admin'] ?></div>
                <div class="color_employees">Employees : <?= $nbr_employees['nbr_employees'] ?></div>
            </div>
                <div class="title_users_section">
                    <h2>Users</h2> 
                    
                    <button type="submit" name="add_user" onclick="show_form_add_user()">Add user</button>
                </div>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>actions</th>
                </tr>

            <?php while($users = $users_sql ->fetch_assoc()): ?>
                <tr>
                    <td><?= $users['id'] ?></td>
                    <td><?= $users['full_name'] ?></td>
                    <td><?= $users['email'] ?></td>
                    <td><?= $users['role'] ?></td>
                    <td class="flex_button">
                        <a class="btn delete-btn" href="../actions/delete_user.php?delete=<?= $users['id'];?>"> Delete </a>
                        <a class="btn update-btn" href="../actions/update_user.php?id=<?= $users['id'];?>"> Update </a>
                    </td>
                </tr>
                
            <?php endwhile ?>
            </table>
        </article>
        
    </main>
    <div class="container_form_add" id="add_user_form">
    <div class="form_info" id="add_user_form">
        <form action="gestion_utilisateur.php" method="POST">
            <h3>Add user</h3>
                <?php if ($email_error):?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            show_form_add_user(); 
                    });
                    </script>
                <?php endif;?>
                <?php if (isset($_SESSION['add_user_error'])): ?>
                    <p class="error_message"><?= $_SESSION['add_user_error'] ?></p>
                    <?php unset($_SESSION['add_user_error']); ?>
                <?php endif; ?>
            <input type="text" name="full_name" placeholder="Your full name" required >
            <input type="email" name="email" placeholder="Your email" required >
            <input type="password" name="password" placeholder="********" required>
            <select name="role" id="role" required>
                <option value="">-- chose a role -- </option>
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select>      
            <button type="submit"  name="add_user_form_submit">Add</button>
            <button id="cancel_add_uses" onclick="hidde_form_add_user()">Cancel</button>
        </form>
    </div>
    <script src="../js/script.js">
    </script>
</body>
</html>