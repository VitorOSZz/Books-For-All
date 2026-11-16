<?php
session_start();
include "utils.php";
check_login();

include "database.php";

$id_usuario = $_SESSION["id_usuario"];
$query = "SELECT nome, telefone, data_nasc, senha FROM usuario WHERE id_usuario = '$id_usuario'";
$sql = $conn->query($query);
$row = $sql ->fetch_assoc();

$usuario = array(
    "nome" => $row["nome"],
    "telefone" => $row["telefone"],
    "data_nascimento" => $row["data_nasc"],
    "senha" => $row["senha"]
);


// CODIGO NAO TESTADO. VERIFICAR SE UM USUARIO SEM TELEFONE APARECE O DEFAULT.
if (!isset($usuario["telefone"])) {
    $usuario["telefone"] = "+55 41 99067-67067";
}

if (!isset($usuario["data_nascimento"])) {
    $usuario["data_nascimento"] = "06/07/0670";
}

if (isset($usuario["data_nascimento"])) {
    $date = $usuario["data_nascimento"];
    $date = explode("/", $date);
    #$date = "$date[2]/$date[1]/$date[0]";
    $date = $date[0];
    $usuario["data_nascimento"] = $date;
}

if (!isset($usuario["senha"])) {
    $usuario["senha"] = "Como você não tem senha?";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nome ?></title>

    <link rel="stylesheet" href="root.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="user_config.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="src/book-icon.png" alt="Logo">
            <h1>Books for All</h1>
        </div>
        <a href="user_config.php">⚙</a>
    </header>

    <main>

        <section id="user_configs">
            <div><h2>Configurações da conta</h2>

                <form action="user_config_process.php" method="POST">

                    <h3>Informações pessoais</h3>

                    <div>
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" value="<?php echo($usuario["nome"]) ?>">
                    </div>

                    <div>
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" value="<?php echo($usuario["telefone"])?>">
                    </div>

                    <div>
                        <label for="data_nascimento">Data nascimento</label>
                        <input type="date" name="data_nascimento" value="<?php echo($usuario["data_nascimento"])?>">
                    </div>

                    <div id="password_field">
                        <label for="password_field">Senha</label>
                        <div>
                            <input type="password" name="password_field" id="password_input" value="<?php echo($usuario["senha"])?>">
                            <input type="checkbox" onclick="toggle_password()">
                        </div>
                    </div>

                    <div>
                        <input type="submit" value="Confirmar">
                    </div>
                </form>
            </div>

            <form action="update_lists.php" method="POST" id="lists">
                
                <h3>Listas</h3>

                <div id="dynamic_lists">
                    <?php

                        $query = "SELECT id_lista, nome FROM lista WHERE id_usuario = $id_usuario";
                        $data = $conn->query($query);

                        if ($data && $data->num_rows > 0) {

                            while ($row = $data->fetch_assoc()) {

                                $id_lista = $row['id_lista'];
                                $nome = $row['nome'];

                                echo "
                                    <div>
                                        <label for='$id_lista'></label>
                                        <input type='text' id='$id_lista' name='$id_lista' value='$nome'>
                                    </div>
                                ";
                            }

                        } else {

                            echo '
                                <div>
                                    <label for="id_favoritos"></label>
                                    <input type="text" id="id_favoritos" name="id_favoritos" value="Favoritos">
                                </div>

                                <div>
                                    <label for="id_lendo"></label>
                                    <input type="text" id="id_lendo" name="id_lendo" value="Lendo">
                                </div>
                            ';
                        }

                    ?>

                </div>
                
                <div id="lists_buttons">
                    <input type="submit" value="Atualizar">
                    <input type="button" value="Adicionar lista" onclick="add_list()">
                </div>
                
            </form>

        </section>

    </main>

    <script>

        let new_lists = 0;

        function toggle_password() {
            const input_password = document.querySelector("#password_input");

            if (input_password.type === "password") {
                input_password.type = "text";
            } else {
                input_password.type = "password";
            }
        }

        function add_list() {
            console.log("penes");
            const lists = document.querySelector("#dynamic_lists");
            const label = document.createElement("label");
            label.setAttribute("for", `new${new_lists}`);

            const input = document.createElement("input");
            input.type = "text";
            input.name = `new${new_lists}`;
            input.value = "Nova lista";

            lists.appendChild(label);
            lists.appendChild(input);
            new_lists++;
        }

        const dynamic_lists = document.querySelectorAll("#dynamic_lists div");

        dynamic_lists.forEach(div => {
            const input = div.querySelector("input");

            if (input.value === "Lendo" || input.value === "Favoritos") {
                div.classList.add("block");
            }
        });
    </script>
    
</body>
</html>