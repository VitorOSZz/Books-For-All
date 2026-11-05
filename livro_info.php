<?php
session_start();
include("utils.php");
check_login();

include "database.php";
$id = $_GET['id'] ?? null;

$data = $conn->query("SELECT nome, sinopse, endereco_capa, isbn_editora, data_lancamento, genero FROM livro WHERE isbn_livro = " . $id);

$nome = "Nome não encontrado";
$sinopse = "Sinopse não encontrado";
$endereco_capa = "Imagem nao encontrada";
$isbn_editora = 0;
$data_livro = "Data do livro não encontrado";
$genero = "Genero não encontrado";
while ($row = $data->fetch_assoc()) {
    $nome = $row["nome"];
    $sinopse = $row["sinopse"];
    $endereco_capa = $row["endereco_capa"];
    $isbn_editora = $row["isbn_editora"];

    if ($row["data_lancamento"] !== null) {
        $data_livro = $row["data_lancamento"];
    }
    $genero = $row["genero"];
}
$autor = "Autor não encontrado";
$data = $conn->query("SELECT nome_autor FROM autor WHERE isbn_livro = " . $id);
while ($row = $data->fetch_assoc()) {
    $autor = $row["nome_autor"];
}

/*

*/
$editora = "Editora não encontrado";
$data = $conn->query("SELECT nome FROM editora WHERE isbn_editora = " . $isbn_editora);
while ($row = $data->fetch_assoc()) {
    $editora = $row["nome"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header>
        <div id="logo">
            <img src="src/book-icon.png">
            <h1>Books for All</h1>
        </div>
    </header>

    <main>
        <section id="book-details">
            <div id="book-cover">

                <img src="<?php echo $endereco_capa ?>" alt="">
            </div>

            <div id="book-info">

                <p id="nome"><?php echo $nome; ?></p>
                <div class="line"></div>

                <p id="autor"><?php echo $autor ?></p>
                <div class="line"></div>

                <p id="data"><?php echo $data_livro ?></p>
                <div class="line"></div>

                <p id="genero"><?php echo $genero ?> </p>
                <div class="line"></div>

                <p id="editora"><?php echo $editora ?></p>
                <div class="line"></div>

                <p id="sinopse"><?php echo $sinopse ?> </p>
            </div>
        </section>

        <section id="book-utils">

            <div id="Add_to_array_button">
                <button onclick="try_add_list(<?php echo $id ?>)">Adicionar na lista</button>
            </div>

            <div id="read">
                <a href="../books-for-all/livro/livro.php?id=<?php echo $id = $_GET['id'] ?? null; ?>"> Ler livro</a>
            </div>
        </section>
    </main>

    <footer>

    </footer>

    <script src="listas/listas.js"></script>
</body>

</html>