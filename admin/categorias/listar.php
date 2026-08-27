<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../idioma.php';

$stmt = $pdo->prepare("SELECT * FROM categorias ORDER BY nome");
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../../includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['lista_categorias'] ?></h2>

    <a class="btn" href="cadastrar.php"><?= $traducao['cadastrar_categoria'] ?></a>

    <br><br>

    <div class="cards">

        <?php foreach ($categorias as $categoria): ?>

            <div class="card">

                <h3><?= htmlspecialchars($categoria['nome']) ?></h3>

                <p><?= htmlspecialchars($categoria['descricao']) ?></p>

                <div class="acoes">
                    <a class="btn editar" href="editar.php?id=<?= $categoria['id'] ?>"><?= $traducao['editar'] ?></a>

                    <a class="btn excluir"
                       href="excluir.php?id=<?= $categoria['id'] ?>"
                       onclick="return confirm('<?= $traducao['confirmar_exclusao_categoria'] ?>')">
                        <?= $traducao['excluir'] ?>
                    </a>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
