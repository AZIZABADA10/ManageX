<?php

session_start();
$errors = [
    'login_err' => $_SESSION['login_error'] ?? '',
    'register_err' => $_SESSION['register_error']?? ''
];


$form_active = $_SESSION['form_active'] ?? 'login';

session_unset();

function show_error($error){
    return !empty($error)? "<p class='error_message'>$error</p>":'';
}

function form_active($form_name,$form_active){
    return $form_name === $form_active ? 'active':'';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form_info <?= form_active('login',$form_active) ?>" id="login_form">
            <form action="auth.php" method="POST">
                <h2>Login</h2>
                <?= show_error($errors['login_err']); ?>
                <input type="email" name="email" placeholder="Your email" required>
                <input type="password" name="password" placeholder="********" required>      
                <button type="submit" name="login_submit">Connect</button>
            </form>
            <p><a href="#" onclick="changer_form('register_form');">sin'up</a></p>
        </div>
        <div class="form_info  <?= form_active('register',$form_active) ?>" id="register_form">
            <form action="auth.php" method="POST">
                <h2>Register</h2>
                <?= show_error($errors['register_err']); ?>
                <input type="text" name="full_name" placeholder="Your full name" required >
                <input type="email" name="email" placeholder="Your email" required >
                <input type="password" name="password" placeholder="********" required>
                <select name="role" id="role" required>
                    <option value="">-- chose a role -- </option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>      
                <button type="submit" name="register_submit">Connect</button>
            </form>
            <p><a href="#" onclick="changer_form('login_form');">login</a></p>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>