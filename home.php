<?php 
    include ("database.php");
    session_start();
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
            <h1 class="row-title"> Continue lendo</h1>
            <div class="books-row">
                <?php  
                    $sql = "SELECT isbn_livro, endereco_capa, endereco_conteudo FROM livro";
                    $query = $conn -> query($sql);
                    while ($row = $query -> fetch_assoc()) {
                        $isbn = $row['isbn_livro'];
                        $capa = $row['endereco_capa'];
                        $conteudo = $row['endereco_conteudo'];
                        $style = "width: 100%; height: 100%; object-fit: cover;";
                        echo "<div class='book' id='$isbn' onclick='livro_info(id)'>
                                 <img src='$capa' style='$style'>
                              </div>";
                    }
                ?>
            </div>

            <div class="line"> </div>

            <h1 class="row-title"> Continue lendo</h1>
            <div class="books-row">
                <div class="book" onclick="livro_info()"></div>
                <div class="book" onclick="livro_info()"></div>
                <div class="book" onclick="livro_info()"></div>
                <div class="book" onclick="livro_info()"></div>
                <div class="book" onclick="livro_info()"></div>
            </div>

        </section>
    </main>
    <footer>

    </footer>
    <script>
        function livro_info(id) {
            window.location.href = `livro_info.php?id=${id}`;
        }
    </script>
</body>
</html>