<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/conexao.php';
require_once 'idioma.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $traducao['dashboard'] ?></title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>

    <h1><?= $traducao['titulo'] ?></h1>

    <div class="btn">
        <a href="?lang=pt">Português -- </a>
        <a href="?lang=en">English -- </a>
        <a href="?lang=it">Italiano</a>
    </div>

</header>

<main>

    <section class="container">

        <h1>
            <?= $traducao['bem_vindo'] ?>,
            <?= htmlspecialchars($_SESSION['usuario']) ?>!
        </h1>

        <p><?= $traducao['logado'] ?></p>

        <div class="btn">

            <a href="index.php">
                <?= $traducao['adicionar'] ?>
            </a>

            <br><br>

            <a href="admin/categorias/listar.php">
                <?= $traducao['categoria'] ?>
            </a>

            <br><br>

            <a href="admin/usuarios/listar.php">
                <?= $traducao['usuario'] ?>
            </a>

            <br><br>

            <a href="sobre.php">
                <?= $traducao['sobre'] ?>
            </a>

            <br><br>

            <a href="logout.php">
                <?= $traducao['sair'] ?>
            </a>

        </div>

    </section>

</main>

<footer>

    <p>- <?= $traducao['rodape'] ?> -</p>

</footer>

</body>

</html>