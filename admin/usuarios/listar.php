<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../idioma.php';

$stmt = $pdo->prepare("SELECT idusuario, usuario FROM usuarios ORDER BY usuario");
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../../includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['lista_usuarios'] ?></h2>

    <a class="btn" href="cadastrar.php"><?= $traducao['cadastrar_usuario'] ?></a>

    <br><br>

    <div class="cards">

        <?php foreach ($usuarios as $usuario): ?>

            <div class="card">

                <h3><?= htmlspecialchars($usuario['usuario']) ?></h3>

                <?php if ($usuario['usuario'] === $_SESSION['usuario']): ?>
                    <p><em>(<?= $traducao['bem_vindo'] ?>)</em></p>
                <?php endif; ?>

                <div class="acoes">
                    <a class="btn editar" href="editar.php?id=<?= $usuario['idusuario'] ?>"><?= $traducao['editar'] ?></a>

                    <?php if ($usuario['idusuario'] != $_SESSION['id']): ?>
                        <a class="btn excluir"
                           href="excluir.php?id=<?= $usuario['idusuario'] ?>"
                           onclick="return confirm('<?= $traducao['confirmar_exclusao_usuario'] ?>')">
                            <?= $traducao['excluir'] ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
