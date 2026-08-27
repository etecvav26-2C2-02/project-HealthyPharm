<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';
require_once __DIR__ . '/../../idioma.php';
require_once __DIR__ . '/../../includes/criptografia.php';

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE idusuario = :id";
$comando = $pdo->prepare($sql);

$comando->execute([
    ':id' => $id
]);

$usuario = $comando->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

$erro = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $novo_usuario = trim($_POST['usuario']);
    $nova_senha = $_POST['senha'];

    if ($novo_usuario === '') {
        $erro = "O nome de usuário não pode ficar em branco.";
    } else {

        // Confere se outro usuário já usa esse nome
        $verifica = $pdo->prepare("SELECT idusuario FROM usuarios WHERE usuario = :usuario AND idusuario != :id");
        $verifica->execute([':usuario' => $novo_usuario, ':id' => $id]);

        if ($verifica->fetch()) {
            $erro = "Esse nome de usuário já está em uso.";
        } else {

            if ($nova_senha !== '') {
                // Senha foi preenchida: atualiza usuário e senha
                $update = "UPDATE usuarios SET usuario = :usuario, senha = :senha WHERE idusuario = :id";

                $comando = $pdo->prepare($update);
                $comando->execute([
                    ':usuario' => $novo_usuario,
                    ':senha' => protegerSenha($nova_senha),
                    ':id' => $id
                ]);
            } else {
                // Senha em branco: mantém a senha atual, atualiza só o nome
                $update = "UPDATE usuarios SET usuario = :usuario WHERE idusuario = :id";

                $comando = $pdo->prepare($update);
                $comando->execute([
                    ':usuario' => $novo_usuario,
                    ':id' => $id
                ]);
            }

            // Se o usuário editou a si mesmo, atualiza o nome na sessão
            if ($id == $_SESSION['id']) {
                $_SESSION['usuario'] = $novo_usuario;
            }

            header("Location: listar.php");
            exit;
        }
    }
}

require_once __DIR__ . '/../../includes/header.php'; ?>

<section class="container">

    <h2><?= $traducao['editar_usuario'] ?></h2>

    <?php if ($erro): ?>
        <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST">

        <input type="text"
               name="usuario"
               value="<?= htmlspecialchars($usuario['usuario']) ?>"
               required>

        <input type="password"
               name="senha"
               placeholder="<?= $traducao['nova_senha'] ?>">

        <button type="submit"><?= $traducao['salvar_alteracoes'] ?></button>

    </form>

    <br>
    <a class="btn" href="listar.php"><?= $traducao['voltar'] ?></a>

</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
