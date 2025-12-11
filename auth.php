<?php

session_start();
require_once 'config.php';

if (isset($_POST['register_submit'])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $verify_email = $connexion -> query("SELECT email FROM users WHERE email = '$email'");
    if ($verify_email -> num_rows > 0) {

        $_SESSION['register_error'] = "The email is alredy exist !";
        $_SESSION['form_active'] = 'register';

    }else{

        $connexion -> query("INSERT INTO users 
        (`full_name`,`email`,`password`,`role`) 
        VALUES 
        ('$full_name','$email','$password','$role');");

    }
    header('Location: authentification.php');
    exit();
}

if (isset($_POST['login_submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_connect = $connexion -> query("SELECT * FROM users WHERE email = '$email'");
    $user = $user_connect -> fetch_assoc();

    if (password_verify($password,$user['password'])) {

        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];

        if ($user['role'] === 'admin') {
            header('Location: pages/admin_pages/home.php');
        }else{
            header('Location: pages/user_pages/user_page.php');
        }
        exit();
    }

    $_SESSION['login_error'] = ' inccoret email or password';
    $_SESSION['form_active'] = 'login';
    header('Location: authentification.php');
    exit();
}

?>