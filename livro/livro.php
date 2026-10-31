<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Escrever isso depois' ?></title>
</head>

<body>

    <iframe src="../src/Livros Book for All/Alice no pais das maravilhas.pdf" width="100%" height="500px" title="Visualizador de PDF" id="texto">
    </iframe>

    <br>

    <button onclick="carregarTextoPDF()">
        Preparar leitura
    </button>

    <button onclick="Leitor.ler_texto('textoExtraido')">
        Ler texto
    </button>

    <div id="textoExtraido"></div>

</body>

<script type="module" src="Leitor.js"></script>

</html>