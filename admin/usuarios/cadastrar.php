<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../idioma.php';
require_once __DIR__ . '/../../includes/criptografia.php';

$erro = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuario = trim($_POST['usuario']);
    $senha = $_POST['senha'];

    if ($usuario === '' || $senha === '') {
        $erro = "Preencha usuário e senha.";
    } else {

        // Confere se o nome de usuário já existe
        $verifica = $pdo->prepare("SELECT idusuario FROM usuarios WHERE usuario = :usuario");
        $verifica->execute([':usuario' => $usuario]);

        if ($verifica->fetch()) {
            $erro = "Esse nome de usuário já está em uso.";
        } else {

            $senha_protegida = protegerSenha($senha);

            $sql = "INSERT INTO usuarios (usuario, senha) VALUES (:usuario, :senha)";

            $comando = $pdo->prepare($sql);

            $comando->execute([
                ':usuario' => $usuario,
                ':senha' => $senha_protegida
            ]);

            header("Location: listar.php");
            exit;
        }
    }
}

require_once __DIR__ . '/../../includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['cadastrar_usuario'] ?></h2>

    <?php if ($erro): ?>
        <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="usuario" placeholder="<?= $traducao['usuario'] ?>"
               value="<?= isset($usuario) ? htmlspecialchars($usuario) : '' ?>" required>

        <input type="password" name="senha" placeholder="<?= $traducao['senha'] ?>" required>

        <button type="submit"><?= $traducao['cadastrar'] ?></button>

    </form>

    <br>
    <a class="btn" href="listar.php"><?= $traducao['voltar'] ?></a>

</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
