<?php

session_start();

require_once 'idioma.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $traducao['login'] ?></title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="login-page">

    <div class="login-container">

        <h1>HealthyPharm</h1>

        <h2><?= $traducao['login'] ?></h2>

        <div class="idiomas">
            <a href="?lang=pt">Português</a>
            <a href="?lang=en">English</a>
            <a href="?lang=it">Italiano</a>
        </div>

        <form action="validar.php" method="POST">

            <label><?= $traducao['usuario'] ?></label>

            <input type="text" name="usuario" required>


            <label><?= $traducao['senha'] ?></label>

            <input type="password" name="senha" required>


            <button type="submit" class="btn-entrar">
                <?= $traducao['entrar'] ?>
            </button>

        </form>

    </div>

</body>

</html>