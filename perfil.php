<?php
include './db.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$sucesso = '';
$erro = '';
$id = $_SESSION['usuario_id'];

// Buscar dados do usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Atualizar dados
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);

    $update = $pdo->prepare("UPDATE usuarios SET nome = ?, telefone = ? WHERE id = ?");
    if ($update->execute([$nome, $telefone, $id])) {
        $sucesso = "Dados atualizados com sucesso!";
        $_SESSION['usuario_nome'] = $nome;
    } else {
        $erro = "Erro ao atualizar os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Perfil do Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container py-5">
  <h2 class="mb-4">Meu Perfil</h2>

  <?php if ($erro): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
  <?php endif; ?>
  <?php if ($sucesso): ?>
    <div class="alert alert-success"><?= $sucesso ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label>Nome:</label>
      <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Email:</label>
      <input type="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" disabled>
    </div>
    <div class="mb-3">
      <label>Telefone:</label>
      <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($usuario['telefone']) ?>">
    </div>
    <button type="submit" class="btn btn-warning">Salvar Alterações</button>
  </form>
</div>

</body>
</html>
