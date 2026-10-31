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
        <div id="login-box">
            <form name="login" method="POST" action="cadastro_process.php">
                Nome: <input type="text" name="nome" id="nome">
                Email: <input type="text" name="email" id="email">
                Senha: <input type="text" name="senha" id="senha">
                Confirmar Senha: <input type="text" id="senha-confirm">
                <input type="submit" id="button" value="Realizar cadastro">
            </form>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>