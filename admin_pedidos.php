<?php
include 'admin_layout.php';
include './db.php';

$stmt = $pdo->query("
  SELECT pedidos.*, usuarios.nome AS cliente 
  FROM pedidos 
  JOIN usuarios ON pedidos.usuario_id = usuarios.id 
  ORDER BY pedidos.data_pedido DESC
");
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="mb-4">Pedidos</h2>

<?php if (count($pedidos) > 0): ?>
  <div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
      <thead class="table-secondary text-dark">
        <tr>
          <th>#</th>
          <th>Cliente</th>
          <th>Data</th>
          <th>Total</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pedidos as $p): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['cliente']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($p['data_pedido'])) ?></td>
            <td>R$ <?= number_format($p['preco_total'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['status']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <div class="alert alert-warning">Nenhum pedido encontrado.</div>
<?php endif; ?>

<?php include 'admin_rodape.php'; ?>
