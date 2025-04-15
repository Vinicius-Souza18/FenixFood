<?php
session_start();

include './admin_layout.php';
include './admin_verifica.php';
include './db.php';

// Dados do dashboard
$total_pedidos = $pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
$total_faturado = $pdo->query("SELECT SUM(preco_total) FROM pedidos")->fetchColumn();
$total_usuarios = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel Admin - Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap e Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  
 <!--<style>
    body {
      background-color: #121212;
      color: #f0f0f0;
    }
    .sidebar {
      background-color: #1e1e1e;
      height: 100vh;
      position: fixed;
      width: 250px;
      padding-top: 60px;
    }
    .sidebar a {
      color: #ccc;
      padding: 12px 20px;
      display: block;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #333;
      color: #fff;
    }
    .content {
      margin-left: 250px;
      padding: 40px;
    }
    .card {
      background-color: #2c2c2c;
      border: none;
      border-radius: 10px;
      color: #fff;
    }
    .card i {
      font-size: 2rem;
    }
  </style> -->
</head>
<body>
  <!-- SIDEBAR -->
  <div class="sidebar position-fixed">
    <h4 class="text-center text-warning mb-4">🍔 Admin</h4>
    <a href="admin_dashboard.php" class="active"><i class="fas fa-chart-line me-2"></i>Dashboard</a>
    <a href="admin_pedidos.php"><i class="fas fa-receipt me-2"></i>Pedidos</a>
    <a href="admin_produtos.php"><i class="fas fa-hamburger me-2"></i>Produtos</a>
    <a href="admin_usuarios.php"><i class="fas fa-users me-2"></i>Usuários</a>
    <a href="admin_cupons.php"><i class="fas fa-ticket-alt me-2"></i>Cupons</a>
    <a href="admin_logout.php" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i>Sair</a>
  </div>
</body>
<?php 
include './admin_rodape.php'
?>
</html>
