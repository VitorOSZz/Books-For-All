<?php

session_start();
header("Content-Type: application/json");

include("database.php");

if (!isset($_SESSION["id_usuario"])) {
    http_response_code(401);

    echo json_encode([
        "success" => false,
        "message" => "Você precisa estar logado."
    ]);

    exit;
}

$id_book = filter_input(INPUT_POST, "id_book", FILTER_VALIDATE_INT);

if (!$id_book || $id_book <= 0) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Livro inválido."
    ]);

    exit;
}

$id_usuario = $_SESSION["id_usuario"];

$sql = "SELECT id_lista FROM lista
        WHERE nome = 'Favoritos'
        AND id_usuario = $id_usuario";

$query = $conn->query($sql);

if ($query->num_rows > 0) {

    $row = $query->fetch_assoc();
    $id_lista = $row["id_lista"];

} else {

    $sql = "INSERT INTO lista (nome, id_usuario)
            VALUES ('Favoritos', $id_usuario)";

    $conn->query($sql);

    $id_lista = $conn->insert_id;
}

$sql = "SELECT * FROM livro_lista
        WHERE id_lista = $id_lista
        AND isbn_livro = $id_book";

$query = $conn->query($sql);

if ($query->num_rows > 0) {

    echo json_encode([
        "success" => false,
        "message" => "Este livro já está nos favoritos."
    ]);

    exit;
}

$sql = "INSERT INTO livro_lista (id_lista, isbn_livro)
        VALUES ($id_lista, $id_book)";

$conn->query($sql);

echo json_encode([
    "success" => true,
    "message" => "Livro adicionado aos favoritos!"
]);

?>