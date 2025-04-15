<?php
include './admin_verifica.php';
include './db.php';

// Consultas resumidas
$totalPedidos = $pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
$totalProdutos = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
$totalClientes = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
$totalFaturamento = $pdo->query("SELECT SUM(preco_total) FROM pedidos")->fetchColumn();
$totalFaturamento = $totalFaturamento ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Relatório - Painel Admin</title>
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
        <li class="nav-item"><a href="admin_pedidos.php" class="nav-link text-white">Pedidos</a></li>
        <li class="nav-item"><a href="admin_usuarios.php" class="nav-link text-white">Clientes</a></li>
        <li class="nav-item"><a href="admin_relatorio.php" class="nav-link active text-warning fw-bold">Relatório</a></li>
        <li class="nav-item mt-3"><a href="logout.php" class="nav-link text-danger">Sair</a></li>
      </ul>
    </aside>

    <!-- Conteúdo -->
    <main class="flex-fill p-4">
      <div class="container-fluid">
        <h3 class="text-warning mb-4"><i class="fas fa-chart-line"></i> Relatórios Gerais</h3>

        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="bg-primary text-white p-4 rounded shadow">
              <h5><i class="fas fa-boxes"></i> Produtos</h5>
              <h2><?= $totalProdutos ?></h2>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="bg-success text-white p-4 rounded shadow">
              <h5><i class="fas fa-shopping-cart"></i> Pedidos</h5>
              <h2><?= $totalPedidos ?></h2>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="bg-warning text-dark p-4 rounded shadow">
              <h5><i class="fas fa-users"></i> Clientes</h5>
              <h2><?= $totalClientes ?></h2>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="bg-danger text-white p-4 rounded shadow">
              <h5><i class="fas fa-coins"></i> Faturamento</h5>
              <h2>R$ <?= number_format($totalFaturamento, 2, ',', '.') ?></h2>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
