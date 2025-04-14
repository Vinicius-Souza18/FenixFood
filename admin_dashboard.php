<?php
include 'admin_verifica.php';
include 'db.php';

// Totais
$totalProdutos = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
$totalUsuarios = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
$totalPedidos = $pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();

// Faturamento do mês atual
$dataAtual = date('Y-m');
$stmt = $pdo->prepare("SELECT SUM(preco_total) FROM pedidos WHERE DATE_FORMAT(criado_em, '%Y-%m') = ?");
$stmt->execute([$dataAtual]);
$totalFaturado = $stmt->fetchColumn() ?? 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin | DeliveryCompleto</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    .card-link {
      text-decoration: none;
    }
    .card:hover {
      transform: scale(1.03);
      transition: 0.3s;
    }
  </style>
</head>
<body class="bg-dark text-white">

<?php include 'admin_nav.php'; ?>

<div class="container py-5">
  <h2 class="mb-4">📊 Painel Administrativo</h2>

  <div class="row g-4">

    <!-- Produtos -->
    <div class="col-md-3">
      <a href="admin_produtos.php" class="card-link">
        <div class="card bg-primary text-white shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h6>Total de Produtos</h6>
              <h3 class="fw-bold"><?= $totalProdutos ?></h3>
            </div>
            <i class="fas fa-box fa-2x"></i>
          </div>
        </div>
      </a>
    </div>

    <!-- Usuários -->
    <div class="col-md-3">
      <a href="admin_usuarios.php" class="card-link">
        <div class="card bg-success text-white shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h6>Total de Clientes</h6>
              <h3 class="fw-bold"><?= $totalUsuarios ?></h3>
            </div>
            <i class="fas fa-users fa-2x"></i>
          </div>
        </div>
      </a>
    </div>

    <!-- Pedidos -->
    <div class="col-md-3">
      <a href="admin_pedidos.php" class="card-link">
        <div class="card bg-warning text-dark shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h6>Total de Pedidos</h6>
              <h3 class="fw-bold"><?= $totalPedidos ?></h3>
            </div>
            <i class="fas fa-clipboard-list fa-2x"></i>
          </div>
        </div>
      </a>
    </div>

    <!-- Faturamento -->
    <div class="col-md-3">
      <a href="admin_relatorios.php" class="card-link">
        <div class="card bg-danger text-white shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h6>Faturamento do mês</h6>
              <h3 class="fw-bold">R$ <?= number_format($totalFaturado, 2, ',', '.') ?></h3>
            </div>
            <i class="fas fa-money-bill-wave fa-2x"></i>
          </div>
        </div>
      </a>
    </div>

  </div>

  <div class="text-end mt-4">
    <a href="admin_produto_novo.php" class="btn btn-outline-light">➕ Cadastrar Novo Produto</a>
  </div>
</div>

<?php include 'admin_rodape.php'; ?>
</body>
</html>
