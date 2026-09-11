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
    $categoria_id = $_POST['categoria_id'] !== '' ? $_POST['categoria_id'] : null;

    $update = "UPDATE produtos
               SET nome = :nome,
                   receita = :receita,
                   descricao = :descricao,
                   categoria_id = :categoria_id
               WHERE id = :id";

    $comando = $pdo->prepare($update);

    $comando->execute([
        ':nome' => $nome,
        ':receita' => $remedio,
        ':descricao' => $descricao,
        ':categoria_id' => $categoria_id,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

$categorias = $pdo->query("SELECT * FROM categorias ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

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

        <select name="categoria_id">
            <option value=""><?= $traducao['sem_categoria'] ?></option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>" <?= $produto['categoria_id'] == $categoria['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoria['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit"><?= $traducao['salvar_alteracoes'] ?></button>

    </form>

</section>

<?php require_once 'includes/footer.php'; ?>
