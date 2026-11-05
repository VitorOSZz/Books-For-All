<?php
function check_login()
{
    if (!isset($_SESSION["id_usuario"])) {
        header("Location: login.php");
    }
}

function check_book_in_a_list($isbn, $list)
{
    include("../database.php");
    $user_id = $_SESSION["id_usuario"];

    $sql = "SELECT id_lista FROM lista WHERE nome = '$list' AND id_usuario = '$user_id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $list_id = NULL;

    if (!$row == true) {
        return "false";
    }
    $list_id = $row["id_lista"];



    $sql = "SELECT isbn_livro FROM livro_lista
            WHERE id_lista = '$list_id' AND
                isbn_livro = '$isbn'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if (!$row == true) {
        return "false";
    }

    return "true";
}
?>