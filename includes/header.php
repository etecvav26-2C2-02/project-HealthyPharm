<?php
require_once 'idioma.php';
?>

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

    <div>
<?php
$params = $_GET;
?>

<a href="?<?= http_build_query(array_merge($params, ['lang' => 'pt'])) ?>">Português -- </a>
<a href="?<?= http_build_query(array_merge($params, ['lang' => 'en'])) ?>">English -- </a>
<a href="?<?= http_build_query(array_merge($params, ['lang' => 'it'])) ?>">Italiano</a>
    </div>

    <nav>
        <a href="index.php"><?= $traducao['produtos'] ?></a>
        <a href="cadastro.php"><?= $traducao['cadastrar'] ?></a>
    </nav>
</header>

<main>