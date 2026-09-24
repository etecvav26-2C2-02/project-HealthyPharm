<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/conexao.php';
require_once 'idioma.php';

require_once 'includes/header.php'; ?>

<section class="container">

    <div class="dashboard-boas-vindas">

        <h1>
            <?= $traducao['bem_vindo'] ?>,
            <?= htmlspecialchars($_SESSION['usuario']) ?>!
        </h1>

        <p><?= $traducao['logado'] ?></p>

        <div class="dashboard-menu">

            <a class="btn" href="index.php">
                <?= $traducao['adicionar'] ?>
            </a>

            <a class="btn" href="admin/categorias/listar.php">
                <?= $traducao['categoria'] ?>
            </a>

            <a class="btn" href="admin/usuarios/listar.php">
                <?= $traducao['usuario'] ?>
            </a>

            <a class="btn" href="sobre.php">
                <?= $traducao['sobre'] ?>
            </a>

            <a class="btn sair" href="logout.php">
                <?= $traducao['sair'] ?>
            </a>

        </div>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>
