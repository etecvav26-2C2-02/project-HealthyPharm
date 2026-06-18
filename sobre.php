<?php require_once 'config/conexao.php';
require_once 'idioma.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

    <a href="?lang=pt"> Português -- </a>
    <a href="?lang=en"> English -- </a>
    <a href="?lang=it"> Italiano</a>

    <br><br>

    <?= $traducao['quem_somos'] ?>

    <br><br>
    <a href="dashboard.php"><?= $traducao['inicio'] ?></a>

</body>
</html>