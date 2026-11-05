<?php
session_start();
include("utils.php");
check_login();

include("database.php");

function show_books($query)
{
    while ($row = $query->fetch_assoc()) {
        $isbn = $row['isbn_livro'];
        $capa = $row['endereco_capa'];
        $conteudo = $row['endereco_conteudo'];
        $style = "width: 100%; height: 100%; object-fit: cover;";
        echo "
    <a href='livro_info.php?id=$isbn' class='book' id='$isbn'>
        <img src='$capa' style='$style'>
    </a>
";
    }
}
$id = $_SESSION["id_usuario"];
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
        <section id="books-showcase">
            <h1 class="row-title"> Nossos livros</h1>
            <div class="books-row">
                <?php
                $sql = "SELECT isbn_livro, endereco_capa, endereco_conteudo FROM livro";
                $query = $conn->query($sql);
                show_books($query);
                ?>
            </div>

            <div class="line"> </div>

            <h1 class="row-title"> Continue lendo</h1>
            <div class="books-row">
                <?php
                $sql = "SELECT id_lista FROM lista WHERE id_usuario = '$id' AND nome = 'Lendo'";
                $query = $conn->query($sql);
                $row = $query->fetch_assoc();

                if (!$row == true) {
                    echo "Experimente ler o seu primeiro livro!";
                } else {
                    $id_lista = $row["id_lista"];
                    $sql = "SELECT isbn_livro, endereco_capa, endereco_conteudo FROM livro
                WHERE isbn_livro IN (SELECT isbn_livro FROM livro_lista WHERE id_lista = '$id_lista')";
                    $query = $conn->query($sql);
                    show_books($query);
                }
                ?>
            </div>

            <?php
            echo '<h1>oi</h1';
            $user_lists = [];

            $sql = "SELECT id_lista, nome FROM lista WHERE id_usuario = '$id";
            $data = $conn->query($sql);
            while ($row = $data->fetch_assoc()) {
                array_push($user_lists, $row["nome"]);
                $user_lists[$row["id_lista"]] = $row["nome"];
            }

            foreach (array_keys($user_lists) as $id_list) {
                $nome = $user_lists[$id_list];
                echo "<h1 class='row-title'>'$nome'</h1>";
            }
            ?>

        </section>
    </main>
    <footer>

    </footer>
</body>

</html>