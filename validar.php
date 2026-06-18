<?php
session_start();

require_once 'config/conexao.php';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':usuario' => $usuario
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($senha, $user['senha'])) {

    $_SESSION['id'] = $user['id'];
    $_SESSION['usuario'] = $user['usuario'];

    header("Location: dashboard.php");
    exit;

} else {

    echo "Usuário ou senha inválidos.";

} ?>