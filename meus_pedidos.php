<?php
include './db.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuarioId = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY data_pedido DESC");
$stmt->execute([$usuarioId]);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Meus Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container py-5">
  <h2 class="mb-4">Meus Pedidos</h2>

  <?php if (count($pedidos) > 0): ?>
    <table class="table table-dark table-striped">
      <thead class="table-secondary text-dark">
        <tr>
          <th>#</th>
          <th>Data</th>
          <th>Total</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pedidos as $p): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($p['data_pedido'])) ?></td>
            <td>R$ <?= number_format($p['preco_total'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['status']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-warning">Você ainda não fez nenhum pedido.</div>
  <?php endif; ?>
</div>

</body>
</html>
