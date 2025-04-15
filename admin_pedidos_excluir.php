<?php
include './admin_verifica.php';
include './db.php';

if (!isset($_GET['id'])) {
    header("Location: admin_pedidos.php");
    exit;
}

$id = $_GET['id'];

// Busca o pedido
$stmt = $pdo->prepare("SELECT * FROM pedidos WHERE id = ?");
$stmt->execute([$id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    header("Location: admin_pedidos.php");
    exit;
}

// Se confirmou exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin_pedidos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <div class="bg-secondary p-4 rounded text-center">
      <h2 class="text-warning mb-4"><i class="fas fa-trash-alt"></i> Excluir Pedido</h2>
      <p class="fs-5">Tem certeza que deseja excluir o pedido:</p>
      <h4 class="text-warning">#<?= htmlspecialchars($pedido['id']) ?></h4>

      <form method="POST">
        <button type="submit" class="btn btn-danger px-4">Sim, excluir</button>
        <a href="admin_pedidos.php" class="btn btn-light px-4">Cancelar</a>
      </form>
    </div>
  </div>
</body>
</html>
