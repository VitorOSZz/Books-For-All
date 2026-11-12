<?php   
    session_start();
    include "utils.php";
    check_login();
    include ("database.php");
    $nome = $_POST["nome"] ?? "";
    $data = $_POST["data"] ?? "";
    $genero = $_POST["genero"] ?? "";
    $sinopse = $_POST["sinopse"];
    $isbn_livro = $_SESSION["isbn_livro"] ?? "";
    $info_changed = array($nome, $data, $genero, $sinopse);
    $columns = array("nome", "data_lancamento", "genero", "sinopse");

    $sql = "SELECT isbn_livro FROM livro WHERE isbn_livro = $isbn_livro";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if ($row == true) {
        for ($i = 0; $i < 4; $i++) {
            $sql = "UPDATE livro SET $columns[$i] = '$info_changed[$i]' WHERE isbn_livro = $isbn_livro";
            $query = $conn->query($sql);
            $row;
        }
        
    }
    else {
        echo "Livro não identificado";
    }

?> 