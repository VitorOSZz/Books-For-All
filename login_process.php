<?php
    include ("database.php");
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT email, senha FROM usuario WHERE ((email = '$email') && (senha = '$senha'))";
    $query = $conn -> query($sql);
    $row = $query -> fetch_assoc();
    if ($row == true) {
        header("Location: home.php");
    }
    else {
        echo "login not found";
    }
?>