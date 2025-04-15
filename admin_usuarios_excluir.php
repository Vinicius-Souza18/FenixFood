<?php
include './admin_verifica.php';
include './db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header("Location: admin_usuarios.php");
    exit;
}

$id = $_GET['id'];

// Busca os dados do usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar, redireciona
if (!$usuario) {
    header("Location: admin_usuarios.php");
    exit;
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Exclui o usuário
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin_usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <div class="bg-secondary p-4 rounded text-center">
      <h2 class="text-danger mb-4"><i class="fas fa-trash-alt"></i> Excluir Usuário</h2>
      <p class="fs-5">Tem certeza que deseja excluir o usuário abaixo?</p>
      <h4 class="text-warning"><?= htmlspecialchars($usuario['nome']) ?> (ID: <?= htmlspecialchars($usuario['id']) ?>)</h4>

      <form method="POST">
        <button type="submit" class="btn btn-danger px-4">Sim, excluir</button>
        <a href="admin_usuarios.php" class="btn btn-light px-4">Cancelar</a>
      </form>
    </div>
  </div>
</body>
</html>
