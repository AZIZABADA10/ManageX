<?php

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
    <title>User</title>
    <link rel="stylesheet" href="../style/user_page.css">
</head>
<body style="background:#fff;">
    <div class="box">
        <h1>Hello <span><?= $_SESSION['full_name']; ?></span></h1>
        <p>Welcome to the <span>user</span> page</p>
        <button onclick="window.location.href='../../logout.php'">Se déconnecter</button>
    </div>
</body>
</html>