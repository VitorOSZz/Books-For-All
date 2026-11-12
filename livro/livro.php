<!DOCTYPE html>
<html lang="en">

<?php

session_start();

include("../utils.php");
check_login();

include("../database.php");
include("../add_to_lendo.php");

$id_usuario = (int) $_SESSION["id_usuario"];

$id_book = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id_book || $id_book <= 0) {
    die("Livro inválido.");
}

$sql = "SELECT nome, endereco_conteudo
        FROM livro
        WHERE isbn_livro = $id_book";

$data = $conn->query($sql);

if (!$data || $data->num_rows === 0) {
    die("Livro não encontrado.");
}

$row = $data->fetch_assoc();

$endereco_conteudo = $row["endereco_conteudo"];
$nome = $row["nome"];

if (!add_to_lendo($conn, $id_book, $id_usuario)) {
    die("Não foi possível adicionar o livro à lista Lendo.");
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nome ?></title>
</head>

<body>



    <iframe src="../<?php echo $endereco_conteudo ?>" width="100%" height="500px" title="Visualizador de PDF" id="texto">
    </iframe>

    <br>

    <button onclick="carregarTextoPDF('../<?php echo $endereco_conteudo ?>')">
        Preparar leitura
    </button>

    <button onclick="Leitor.ler_texto('textoExtraido')">
        Ler texto
    </button>

    <div id="textoExtraido"></div>

</body>

<script type="module" src="Leitor.js"></script>

</html>