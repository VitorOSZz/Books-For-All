
<?php
session_start();
include "database.php";

include "utils.php";
check_login();

ini_set("display_errors", 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

try {
    if (!isset($_SESSION["id_usuario"])) {
        throw new Exception("Usuário não autenticado.");
    }

    if (!isset($_POST["id_book"], $_POST["id_lista"])) {
        throw new Exception("Dados incompletos.");
    }

    $id_usuario = $_SESSION["id_usuario"];
    $id_book = $_POST["id_book"];
    $id_lista = $_POST["id_lista"];

    $sql = "CALL toggle_book($id_lista, $id_book)";
    $conn->query($sql);

    echo json_encode([
        "success" => true,
        "message" => "Livro atualizado com sucesso!"
    ]);

} catch (Throwable $e) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
    