<?php
include './admin_verifica.php';
include './db.php';

// Consultas ao banco
$totalPedidos = $pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
$totalUsuarios = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
$totalFaturamento = $pdo->query("SELECT SUM(preco_total) FROM pedidos")->fetchColumn();
$totalFaturamento = $totalFaturamento ?? 0.00;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">
  <div class="d-flex">
    <!-- Sidebar -->
    <aside class="bg-secondary p-4 vh-100" style="width: 250px;">
      <h4 class="text-warning mb-4"><i class="fas fa-utensils me-2"></i>Delivery Admin</h4>
      <ul class="nav flex-column gap-2">
        <li><a href="admin_dashboard.php" class="nav-link text-white"><i class="fas fa-chart-line me-2"></i>Dashboard</a></li>
        <li><a href="admin_produtos.php" class="nav-link text-white"><i class="fas fa-box-open me-2"></i>Produtos</a></li>
        <li><a href="admin_pedidos.php" class="nav-link text-white"><i class="fas fa-receipt me-2"></i>Pedidos</a></li>
        <li><a href="admin_usuarios.php" class="nav-link text-white"><i class="fas fa-users me-2"></i>Clientes</a></li>
        <li><a href="admin_relatorio.php" class="nav-link text-white"><i class="fas fa-chart-pie me-2"></i>Relatório</a></li>
        <li class="mt-3"><a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i>Sair</a></li>
      </ul>
    </aside>

    <!-- Conteúdo -->
    <main class="flex-fill p-5">
      <h2 class="mb-4"><i class="fas fa-chart-line me-2 text-warning"></i>Dashboard</h2>
      
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card bg-warning text-dark shadow rounded-4 p-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-receipt me-2"></i>Total de Pedidos</h5>
              <p class="fs-3 fw-bold"><?= $totalPedidos ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card bg-info text-dark shadow rounded-4 p-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-users me-2"></i>Total de Clientes</h5>
              <p class="fs-3 fw-bold"><?= $totalUsuarios ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card bg-success text-white shadow rounded-4 p-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-money-bill-wave me-2"></i>Faturamento Total</h5>
              <p class="fs-3 fw-bold">R$ <?= number_format($totalFaturamento, 2, ',', '.') ?></p>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</body>
</html>
