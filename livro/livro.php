<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include("../utils.php");
check_login();

include "../database.php";

$id = $_GET['id'] ?? null;
// echo "id: " . $id;

$data = $conn->query("SELECT nome, endereco_conteudo FROM livro WHERE isbn_livro = " . $id);

$endereco_conteudo = "Livro Não encontrado";
$nome = "Livro Não encontrado";
while ($row = $data->fetch_assoc()) {
    $endereco_conteudo = $row["endereco_conteudo"];
    $nome = $row["nome"];
}
//echo "<br>url: " . $endereco_conteudo;

echo '<script>alert(' . check_book_in_a_list($id, "Lendo") . ');</script>';

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