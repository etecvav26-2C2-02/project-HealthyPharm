<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../idioma.php';

$id = $_GET['id'];

$sql = "SELECT * FROM categorias WHERE id = :id";
$comando = $pdo->prepare($sql);

$comando->execute([
    ':id' => $id
]);

$categoria = $comando->fetch(PDO::FETCH_ASSOC);

if (!$categoria) {
    die("Categoria não encontrada.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    $update = "UPDATE categorias
               SET nome = :nome,
                   descricao = :descricao
               WHERE id = :id";

    $comando = $pdo->prepare($update);

    $comando->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':id' => $id
    ]);

    header("Location: listar.php");
    exit;
}

require_once __DIR__ . '/../../includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['editar_categoria'] ?></h2>

    <form method="POST">

        <input type="text"
               name="nome"
               value="<?= htmlspecialchars($categoria['nome']) ?>"
               required>

        <input type="text"
               name="descricao"
               value="<?= htmlspecialchars($categoria['descricao']) ?>">

        <button type="submit"><?= $traducao['salvar_alteracoes'] ?></button>

    </form>

    <br>
    <a class="btn" href="listar.php"><?= $traducao['voltar'] ?></a>

</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
