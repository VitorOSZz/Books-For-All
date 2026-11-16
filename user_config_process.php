<?php
include ("database.php");

session_start();

include ("utils.php");
check_login();

$user_id = $_SESSION['id_usuario'];

$campos = [];

if (!empty($_POST['nome'])) {
    $nome = $_POST['nome'];
    array_push($campos, "nome = '$nome'");
}

if (isset($_POST['telefone'])) {
    $telefone = $_POST['telefone'];
    array_push($campos, "telefone = '$telefone'");
}

if (!empty($_POST['data_nascimento'])) {
    $data_nascimento = $_POST['data_nascimento'];
    array_push($campos, "data_nasc = '$data_nascimento'");
}

if (!empty($_POST['password_field'])) {
    $senha = $_POST['password_field'];
    array_push($campos, "senha = '$senha'");
}

if (!empty($campos)) {
    $sql = "UPDATE usuario SET " . implode(", ", $campos);
    $sql = $sql . " WHERE id_usuario = $user_id";

    try {
        $query = $conn->query($sql);
        header("Location: user_config.php");
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo $e->getMessage();
            die("Não foi possível alguma informação já pertence a outra conta!");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>