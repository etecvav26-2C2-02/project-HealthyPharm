<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once 'idioma.php';
require_once 'config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $remedio = $_POST['receita'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO produtos
            (nome, receita, descricao)
            VALUES
            (:nome, :receita, :descricao)";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':nome' => $nome,
        ':receita' => $remedio,
        ':descricao' => $descricao
    ]);

    header("Location: index.php");
    exit;
}

require_once 'includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['cadastrar_produto'] ?></h2>

    <form method="POST">

        <input type="text" name="nome" placeholder="<?= $traducao['nome'] ?>" required>

        <input type="text" name="receita" placeholder="<?= $traducao['ingredientes'] ?>">

        <input type="text" name="descricao" placeholder="<?= $traducao['medicamento'] ?>" required>

        <button type="submit"><?= $traducao['cadastrar'] ?></button>

    </form>

</section>

<?php require_once 'includes/footer.php'; ?>