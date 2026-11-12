
<?php
session_start();
include("utils.php");
check_login();

include("database.php");

$id = (int) $_SESSION["id_usuario"];

function show_book_section($query, $nome, $id_container)
{
    $livros = [];

    while ($row = $query->fetch_assoc()) {
        $livros[] = $row;
    }

    $tem_mais = count($livros) > 5;

    echo "<section class='book-section'>";

    echo "<div class='list-title'>";

    echo "<h1 class='row-title'>" .
         htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') .
         "</h1>";

    if ($tem_mais) {
        echo "
            <button type='button'
                    class='toggle-list'
                    onclick='toggleList(this)'
                    data-target='$id_container'
                    aria-label='Mostrar mais livros'>
                ▼
            </button>
        ";
    }

    echo "</div>";

    echo "<div class='books-row' id='$id_container'>";

    foreach ($livros as $index => $row) {

        $isbn = htmlspecialchars($row['isbn_livro'], ENT_QUOTES, 'UTF-8');
        $capa = htmlspecialchars($row['endereco_capa'], ENT_QUOTES, 'UTF-8');

        $classe = ($index >= 5) ? "book hidden-book" : "book";

        echo "
            <a href='livro_info.php?id=$isbn' class='$classe'>
                <img src='$capa' alt='Capa do livro'>
            </a>
        ";
    }

    echo "</div>";

    echo "</section>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books for All</title>
    <link rel="stylesheet" href="root.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <header>
        <div id="logo">
            <img src="src/book-icon.png" alt="Logo">
            <h1>Books for All</h1>
        </div>
        <a href="user_config.php">&#9881;</a>
    </header>

    <main>

        <section id="books-showcase">

            <?php

            // NOSSOS LIVROS

            $sql = "SELECT isbn_livro, endereco_capa, endereco_conteudo
                    FROM livro";

            $query = $conn->query($sql);

            show_book_section($query, "Nossos livros", "all-books");

            echo "<div class='line'></div>";


            // CONTINUE LENDO

            $sql = "SELECT id_lista
                    FROM lista
                    WHERE id_usuario = '$id'
                    AND nome = 'Lendo'
                    LIMIT 1";

            $query = $conn->query($sql);

            $row = $query->fetch_assoc();

            if (!$row) {

                echo "
                    <section class='book-section'>
                        <div class='list-title'>
                            <h1 class='row-title'>Continue lendo</h1>
                        </div>

                        <p>Experimente ler o seu primeiro livro!</p>
                    </section>
                ";

            } else {

                $id_lista = (int) $row["id_lista"];

                $sql = "SELECT isbn_livro, endereco_capa, endereco_conteudo
                        FROM livro
                        WHERE isbn_livro IN (
                            SELECT isbn_livro
                            FROM livro_lista
                            WHERE id_lista = '$id_lista'
                        )";

                $query = $conn->query($sql);

                show_book_section(
                    $query,
                    "Continue lendo",
                    "continue-reading"
                );
            }

            echo "<div class='line'></div>";


            // LISTAS PERSONALIZADAS

            $sql = "SELECT id_lista, nome
                    FROM lista
                    WHERE id_usuario = '$id'
                    AND nome <> 'Lendo'";

            $data = $conn->query($sql);

            while ($row = $data->fetch_assoc()) {

                $id_list = (int) $row["id_lista"];
                $nome = $row["nome"];

                $sql = "SELECT isbn_livro, endereco_capa, endereco_conteudo
                        FROM livro
                        WHERE isbn_livro IN (
                            SELECT isbn_livro
                            FROM livro_lista
                            WHERE id_lista = '$id_list'
                        )";

                $query = $conn->query($sql);

                show_book_section(
                    $query,
                    $nome,
                    "list-" . $id_list
                );

                echo "<div class='line'></div>";
            }

            ?>

        </section>

    </main>

    <footer>
    </footer>

    <script>

        function toggleList(button) {

            const id = button.dataset.target;

            const container = document.getElementById(id);

            const livros = container.querySelectorAll(".book");

            const expandir = !button.classList.contains("open");

            livros.forEach((livro, index) => {

                if (index >= 5) {

                    livro.classList.toggle(
                        "hidden-book",
                        !expandir
                    );

                }

            });

            button.classList.toggle("open");

        }

    </script>

</body>
</html>
