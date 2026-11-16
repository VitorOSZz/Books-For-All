<?php
include("database.php");
session_start();
include("utils.php");
check_login();

$user_id = $_SESSION["id_usuario"];
$some_error = false;


foreach ($_POST as $key => $value) {
    #echo "$key is $value<br>";
    # echo substr($key, 3);
    
    # Cria as listas novas e ignora os casos default
    if (substr($key, 0, 3) === "new" OR $key === "id_favoritos" OR $key === "id_lendo") {
        # echo $key . "<br>";
        try {
            $query = "INSERT INTO lista (nome, id_usuario) VALUES ('$value', $user_id) ";

            $conn->query($query);
        } catch (Exception $e) {
            echo "Algum erro aconteceu ao criar a lista. <br>";
            # echo $e->getMessage();
            $some_error = true;
        }
    } else {
        #echo $key . "is update<br>";

        try {
            $query = "UPDATE lista SET nome = '" . $value . "' WHERE id_lista = " . $key;

            $conn->query($query);
        } catch (Exception $e) {
            echo "Algum erro aconteceu ao atualizar a lista. <br>";
            # echo $e->getMessage();
            $some_error = true;
        }
    }
}

if (!$some_error) {
    header("Location: user_config.php");
}
?>