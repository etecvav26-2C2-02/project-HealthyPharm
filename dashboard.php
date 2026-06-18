<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
} 

require_once 'config/conexao.php';
require_once 'idioma.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $traducao['chave'] ?></title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1><?= $traducao['titulo'] ?></h1>
</header>

<main>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $traducao['dashboard'] ?></title>
</head>
<body>

<div class="btn">

    <a href="?lang=pt"> Português -- </a>
    <a href="?lang=en"> English -- </a>
    <a href="?lang=it"> Italiano</a>

</div>

<hr>

<h1><?= $traducao['bem_vindo'] ?>, <?= $_SESSION['usuario']; ?>!</h1>

<p><?= $traducao['logado'] ?></p>

<div class="btn">

    <a href="index.php"><?= $traducao['adicionar'] ?></a>

    <br><br>

    <a href="sobre.php"><?= $traducao['sobre'] ?></a>

    <br><br>
    <a href="logout.php"><?= $traducao['sair'] ?></a>

</div>

</body>
</html>