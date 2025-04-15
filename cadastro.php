<?php
include './db.php';
session_start();

$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o email já está cadastrado
    $check = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $erro = "E-mail já está em uso.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone, endereco, senha) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$nome, $email, $telefone, $endereco, $senha])) {
            $sucesso = "Cadastro realizado com sucesso! Faça o login.";
        } else {
            $erro = "Erro ao cadastrar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center vh-100">

  <div class="card bg-secondary p-4" style="min-width: 400px;">
    <h3 class="text-center mb-3 text-warning">Criar Conta</h3>

    <?php if ($erro): ?>
      <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
      <div class="alert alert-success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Telefone:</label>
        <input type="text" name="telefone" class="form-control">
      </div>
      <div class="mb-3">
        <label>Enderoço:</label>
        <input type="text" name="endereco" class="form-control">
      </div>
      <div class="mb-3">
        <label>Senha:</label>
        <input type="password" name="senha" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-warning w-100">Cadastrar</button>
      <a href="login.php" class="btn btn-outline-light w-100 mt-2">Já tenho conta</a>
    </form>
  </div>

</body>
</html>
