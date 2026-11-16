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
    <link rel="stylesheet" href="root.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="livro_info.css">
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
    
        <div id="book-cover-column">
            <div id="book-cover">
                <img src="<?php echo $endereco_capa ?>" alt="Capa do livro">
            </div>
    
            <div id="Add_to_array_button">
                <button class="dropdown">
                    Adicionar a lista
                </button>
                <div class="dropdown_content">
                    <?php
                    $user_id = $_SESSION["id_usuario"];
                    $data = $conn->query("SELECT id_lista, nome FROM lista WHERE id_usuario = " . $user_id);

                    while ($row = $data->fetch_assoc()) {
                        $id_lista = $row["id_lista"];
                        $nome_lista = $row["nome"];

                        $check_already_list = $conn->query(" SELECT isbn_livro FROM livro_lista WHERE id_lista = $id_lista AND isbn_livro = $id");
                        $already_in_list = $check_already_list->fetch_assoc();

                        if ($already_in_list == true) {
                            echo "<button type='button' onclick='change_list($id, $id_lista)' class='list_active' id='$id'>$nome_lista</button>";
                        } else {
                            echo "<button type='button' onclick='change_list($id, $id_lista)' id='$id'>$nome_lista</button>";
                        }

                    }
                    ?>
                </div>
            </div>
        </div>
    
        <div id="book-info-column">
            <div id="book-info">
    
                <p id="nome"><?php echo $nome; ?></p>
                <div class="line"></div>
    
                <p id="autor"><?php echo $autor ?></p>
                <div class="line"></div>
    
                <p id="data"><?php echo $data_livro ?></p>
                <div class="line"></div>
    
                <p id="genero"><?php echo $genero ?></p>
                <div class="line"></div>
    
                <p id="editora"><?php echo $editora ?></p>
                <div class="line"></div>
    
                <p id="sinopse"><?php echo $sinopse ?></p>
    
            </div>
    
            <div id="read">
                <a href="livro/livro.php?id=<?php echo $id ?>">
                    Ler livro
                </a>
            </div>
        </div>
    
    </section>


    </main>

    <footer>

    </footer>

    <script src="listas/listas.js"></script>
    <script>
        const button = document.querySelector("#Add_to_array_button");
        const content = document.querySelector(".dropdown_content");

        button.addEventListener("mouseenter", () => {
            content.classList.add("active");
        });

        button.addEventListener("mouseleave", () => {
            content.classList.remove("active");});

        
    </script>
</body>

</html>