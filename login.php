<?php
include './db.php';
session_start();

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST['email']);
  $senha = $_POST['senha'];

  $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
  $stmt->execute([$email]);
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    header("Location: index.php");
    exit;
  } else {
    $erro = "E-mail ou senha inválidos.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Login do Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white d-flex justify-content-center align-items-center vh-100">

  <div class="card bg-secondary p-4" style="min-width: 350px;">
    <h3 class="text-center mb-3 text-warning">Login do Cliente</h3>

    <?php if ($erro): ?>
      <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Senha:</label>
        <input type="password" name="senha" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-warning w-100">Entrar</button>
      <a href="cadastro.php" class="btn btn-outline-light w-100 mt-2">Criar Conta</a>
      <div>
        <a href="admin_login.php" class="btn btn-outline-light w-100 mt-2">Paniel Administrador</a>
      </div>

    </form>
  </div>

</body>

</html>