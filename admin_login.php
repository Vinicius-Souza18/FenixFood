<?php
session_start();
include './db.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($senha, $admin['senha'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nome'] = $admin['nome'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 bg-secondary" style="min-width: 350px;">
    <h3 class="text-center mb-3">Painel Administrativo</h3>
    <?php if ($erro): ?>
      <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-warning w-100">Entrar</button>
    </form>
  </div>
</body>
</html>
