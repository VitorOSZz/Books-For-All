<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <form name="login" method="POST" action="login_process.php">
                Email: <input type="text" name="email" id="email">
                Senha: <input type="text" name="senha" id="senha">
                <input type="submit" id="button" value="Entrar">
            </form>
            <form id="form-cadastro" action="cadastro.php">
                <input type="submit" value="Fazer cadastro de Usuario" id="cadastro">
            </form>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>