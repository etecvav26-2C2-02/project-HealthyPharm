<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once 'idioma.php';
require_once 'config/conexao.php';

$stmt = $pdo->prepare("SELECT * FROM produtos");
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['lista_produtos'] ?></h2>

    <div class="cards">

        <?php foreach($produtos as $produto): ?>

            <div class="card">

                <h3><?= ($produto['nome']) ?></h3>

                <p><strong><?= $traducao['remedio'] ?></strong> <?= ($produto['receita']) ?></p>

                <p><strong><?= $traducao['descricao'] ?></strong> <?= $produto['descricao'] ?></p>

                <div class="acoes">
                    <a class="btn editar" href="editar.php?id=<?= $produto['id'] ?>"><?= $traducao['editar'] ?></a>

                    <a class="btn excluir"
                       href="excluir.php?id=<?= $produto['id'] ?>"
                       onclick="return confirm('<?= $traducao['confirmar_exclusao'] ?>')">
                        <?= $traducao['excluir'] ?>
                    </a>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>