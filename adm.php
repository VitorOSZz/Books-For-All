<?php
    include ("database.php");
    session_start();
    
    /* Colocar check_login with admin */
    include "utils.php";
    check_login();

    if ($_SESSION["adm"] == false) {
        echo "fodasse";
    }

    $sql = "SELECT isbn_livro, nome, endereco_capa FROM livro";
    $query = $conn->query($sql);
?>

<!DOCTYPE html><?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="root.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="src/book-icon.png">
            <h1>Books for All</h1>
        </div>
    </header>

    <main id="adm-area">
        <?php 
            $book = 0;
            $rows = 0;
            while($row = $query->fetch_assoc()) {
                if ($book % 5 == 0) {
                    echo "<div class='adm-book-row' id='$rows'>";
                }
                $isbn = $row['isbn_livro'];
                $capa = $row['endereco_capa'];
                $style = "width: 100%; height: 100%; object-fit: cover;";
                echo "
                    <a href='adm_livro_info.php?id=$isbn' class='book' id='$isbn'>
                    <img src='$capa' style='$style'>
                    </a>";
                    $book += 1;
                if ($book % 5 == 0) {
                    echo "</div>";
                    $rows += 1;
                }
            }
            


        ?>
    </main>

    <footer>
        p
    </footer>
    
</body>
</html>