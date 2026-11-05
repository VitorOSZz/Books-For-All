<?php
include("database.php");
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT email, senha FROM usuario WHERE ((email = '$email') && (senha = '$senha'))";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
if ($row == true) {
    session_start();
    $sql = "SELECT id_usuario FROM usuario WHERE email = '$email'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $_SESSION["id_usuario"] = $row["id_usuario"];
    header("Location: home.php");
} else {
    echo "login not found";
}

?>