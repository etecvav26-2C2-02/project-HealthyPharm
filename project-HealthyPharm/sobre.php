<?php
require_once 'config/conexao.php';
require_once 'idioma.php';

require_once 'includes/header.php'; ?>

<section class="container">

    <div class="sobre-container">

        <h2><?= $traducao['sobre'] ?></h2>

        <p><?= nl2br($traducao['quem_somos']) ?></p>

        <a class="btn" href="dashboard.php"><?= $traducao['inicio'] ?></a>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>
