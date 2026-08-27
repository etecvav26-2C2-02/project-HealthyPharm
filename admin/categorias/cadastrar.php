<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../idioma.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    $sql = "INSERT INTO categorias (nome, descricao) VALUES (:nome, :descricao)";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':nome' => $nome,
        ':descricao' => $descricao
    ]);

    header("Location: listar.php");
    exit;
}

require_once __DIR__ . '/../../includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['cadastrar_categoria'] ?></h2>

    <form method="POST">

        <input type="text" name="nome" placeholder="<?= $traducao['nome_categoria'] ?>" required>

        <input type="text" name="descricao" placeholder="<?= $traducao['descricao'] ?>">

        <button type="submit"><?= $traducao['cadastrar'] ?></button>

    </form>

    <br>
    <a class="btn" href="listar.php"><?= $traducao['voltar'] ?></a>

</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
