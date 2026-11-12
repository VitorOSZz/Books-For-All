
<?php

function add_to_lendo($conn, $id_book, $id_usuario)
{
    $id_book = (int) $id_book;
    $id_usuario = (int) $id_usuario;

    if ($id_book <= 0 || $id_usuario <= 0) {
        return false;
    }

    $sql = "SELECT id_lista FROM lista
            WHERE nome = 'Lendo'
            AND id_usuario = $id_usuario";

    $query = $conn->query($sql);

    if ($query->num_rows > 0) {

        $row = $query->fetch_assoc();
        $id_lista = (int) $row["id_lista"];

    } else {

        $sql = "INSERT INTO lista (nome, id_usuario)
                VALUES ('Lendo', $id_usuario)";

        if (!$conn->query($sql)) {
            return false;
        }

        $id_lista = $conn->insert_id;
    }

    $sql = "SELECT * FROM livro_lista
            WHERE id_lista = $id_lista
            AND isbn_livro = $id_book";

    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        return true;
    }

    $sql = "INSERT INTO livro_lista (id_lista, isbn_livro)
            VALUES ($id_lista, $id_book)";

    if (!$conn->query($sql)) {
        return false;
    }

    return true;
}

?>
