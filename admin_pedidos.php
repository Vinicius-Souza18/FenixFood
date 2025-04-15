<?php
include './admin_verifica.php';
include './db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pedidos - Painel Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">
  <div class="d-flex">
    <!-- Sidebar -->
    <aside class="bg-secondary p-3 vh-100" style="width: 250px;">
      <h4 class="text-warning mb-4">Delivery Admin</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">Dashboard</a></li>
        <li class="nav-item"><a href="admin_produtos.php" class="nav-link text-white">Produtos</a></li>
        <li class="nav-item"><a href="admin_pedidos.php" class="nav-link active text-warning fw-bold">Pedidos</a></li>
        <li class="nav-item"><a href="admin_usuarios.php" class="nav-link text-white">Clientes</a></li>
        <li class="nav-item"><a href="admin_relatorio.php" class="nav-link text-white">Relatório</a></li>
        <li class="nav-item mt-3"><a href="logout.php" class="nav-link text-danger">Sair</a></li>
      </ul>
    </aside>

    <!-- Conteúdo -->
    <main class="flex-fill p-4">
      <div class="container-fluid">
        <h3 class="text-warning mb-4"><i class="fas fa-receipt"></i> Pedidos Recebidos</h3>

        <div class="table-responsive bg-dark rounded shadow p-3">
          <table class="table table-dark table-hover table-bordered align-middle">
            <thead class="table-secondary text-dark">
              <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Total</th>
                <th>Status</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stmt = $pdo->query("
                SELECT pedidos.id, usuarios.nome AS cliente, pedidos.produto, pedidos.preco, pedidos.preco_total, pedidos.status, pedidos.data_pedido
                FROM pedidos
                JOIN usuarios ON pedidos.usuario_id = usuarios.id
                ORDER BY pedidos.data_pedido DESC
              ");
              while ($pedido = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?= $pedido['id'] ?></td>
                  <td><?= $pedido['cliente'] ?></td>
                  <td><?= $pedido['produto'] ?></td>
                  <td>R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></td>
                  <td>R$ <?= number_format($pedido['preco_total'], 2, ',', '.') ?></td>
                  <td><span class="badge bg-info text-dark"><?= $pedido['status'] ?></span></td>
                  <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
