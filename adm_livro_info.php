<?php
include "database.php";
$id = $_GET['id'] ?? null;
session_start();
$_SESSION["isbn_livro"] = $id;

echo $_SESSION["isbn_livro"];
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
    <title><?php echo $nome ?></title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header>
        <div id="logo" onclick="menu()">
            <img src="src/book-icon.png">
            <h1>Books for All</h1>
        </div>
    </header>

    <main style="flex-direction: column;">
        <section id="book-details">
            <div id="book-cover">

                <img src="<?php echo $endereco_capa ?>" alt="">
            </div>
            <form name="form" method="POST" action="update.php">
                <div id="book-info">
                    <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>"></input>
                    <div class="line"></div>

                    <p id="autor"><?php echo $autor ?></p>
                    <div class="line"></div>

                    <input type="text" name="data" id="data" value="<?php echo $data_livro ?>"></input>
                    <div class="line"></div>

                    <input type="text" name="genero" id="genero" value="<?php echo $genero ?>"></input>
                    <div class="line"></div>

                    <p id="editora"><?php echo $editora ?></p>
                    <div class="line"></div>

                    <input type="text" name="sinopse" id="sinopse" value="<?php echo $sinopse ?>"></input>
                </div>
        </section>
        <button onclick="book()"> LER </button> 
    </main>

    <footer>

    </footer>

    <script>
        function book() {
            window.location.href = 'livro_leitura.php?id=<?php echo $id ?>';
        }
        
        function menu() {
            window.location.href = 'home.php';
        }
    </script>
</body>

</html>