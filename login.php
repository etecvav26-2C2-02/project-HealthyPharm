<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit;
}

require_once 'idioma.php';
?>

<body>

<a href="?lang=pt"> Português -- </a>
<a href="?lang=en"> English -- </a>
<a href="?lang=it"> Italiano</a>

    <h2><?= $traducao['login'] ?></h2>

    <form action="validar.php" method="POST">

        <label><?= $traducao['usuario'] ?></label>
        <input type="text" name="usuario" required>

        <label><?= $traducao['senha'] ?></label>
        <input type="password" name="senha" required>

        <button type="submit">
            <?= $traducao['entrar'] ?>
        </button>

    </form>

</body>