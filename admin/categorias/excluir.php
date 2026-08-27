<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';

$id = $_GET['id'];

// Os produtos vinculados a esta categoria ficam com categoria_id = NULL
// automaticamente (ON DELETE SET NULL definido no banco).
$sql = "DELETE FROM categorias WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

header("Location: listar.php");
exit; ?>
