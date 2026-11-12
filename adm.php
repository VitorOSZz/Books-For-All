<?php
    include ("database.php");
    
    /* Colocar check_login with admin*/
    include "utils.php";
    check_login();
    $sql = "SELECT isbn_livro, nome, endereco_capa FROM livro";
    $query = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="root.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="src/book-icon.png">
            <h1>Books for All</h1>
        </div>
    </header>

    <main id="adm-area">
        <?php 
            $book = 0;
            $rows = 0;
            while($row = $query->fetch_assoc()) {
                if ($book % 5 == 0) {
                    echo "<div class='adm-book-row' id='$rows'>";
                }
                $isbn = $row['isbn_livro'];
                $capa = $row['endereco_capa'];
                $style = "width: 100%; height: 100%; object-fit: cover;";
                echo "
                    <a href='adm_livro_info.php?id=$isbn' class='book' id='$isbn'>
                    <img src='$capa' style='$style'>
                    </a>";
                    $book += 1;
                if ($book % 5 == 0) {
                    echo "</div>";
                    $rows += 1;
                }
            }
            


        ?>
    </main>

    <footer>
        p
    </footer>
    
</body>
</html>