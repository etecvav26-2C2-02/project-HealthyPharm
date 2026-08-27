<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../idioma.php';

$id = $_GET['id'];

// Trava de segurança: impede que o usuário logado exclua a própria conta
// (isso deixaria o sistema sem ninguém para administrar).
if ($id == $_SESSION['id']) {
    require_once __DIR__ . '/../../includes/header.php';
    echo '<section class="container"><p style="color:red;">' . $traducao['nao_pode_excluir_proprio_usuario'] . '</p>';
    echo '<a class="btn" href="listar.php">' . $traducao['voltar'] . '</a></section>';
    require_once __DIR__ . '/../../includes/footer.php';
    exit;
}

$sql = "DELETE FROM usuarios WHERE idusuario = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

header("Location: listar.php");
exit; ?>
