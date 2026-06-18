<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = :id";
$comando = $pdo->prepare($sql);

$comando->execute([
    ':id' => $id
]);

$produto = $comando->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Rémedio não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $remedio = $_POST['receita'];
    $descricao = $_POST['descricao'];

    $update = "UPDATE produtos
               SET nome = :nome,
                   receita = :receita,
                   descricao = :descricao
               WHERE id = :id";

    $comando = $pdo->prepare($update);

    $comando->execute([
        ':nome' => $nome,
        ':receita' => $remedio,
        ':descricao' => $descricao,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

require_once 'includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['editar_produto'] ?></h2>

    <form method="POST">

        <input type="text"
               name="nome"
               value="<?= ($produto['nome']) ?>"
               required>

        <input type="text"
               name="receita"
               value="<?= ($produto['receita']) ?>"
               required>

        <input type="text"
               name="descricao"
               value="<?= $produto['descricao'] ?>"
               required>

        <button type="submit"><?= $traducao['salvar_alteracoes'] ?></button>

    </form>

</section>

<?php require_once 'includes/footer.php'; ?>