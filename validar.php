<?php
session_start();

require_once 'config/conexao.php';
require_once 'includes/criptografia.php';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha_protegida = protegerSenha($senha);

$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':usuario' => $usuario
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $senha_protegida === $user['senha']) {

    $_SESSION['id'] = $user['idusuario'];
    $_SESSION['usuario'] = $user['usuario'];

    header("Location: dashboard.php");
    exit;

} else {

    echo "Usuário ou senha inválidos.";

} ?>
