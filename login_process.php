<?php
include("database.php");
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id_usuario, email, senha, is_adm FROM usuario WHERE ((email = '$email') && (senha = '$senha'))";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
if ($row == true) {
    session_start();
    if ($row["is_adm"] == true) {
        $_SESSION["id_usuario"] = $row["id_usuario"];
        $_SESSION["adm"] = $row["is_adm"];
        header("Location: adm.php");
    }
    else {
    $_SESSION["adm"] = $row["is_adm"];
    $_SESSION["id_usuario"] = $row["id_usuario"];
    header("Location: home.php");
    }
} else {
    echo "login not found";
}

?>