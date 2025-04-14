<?php
include './admin_layout.php';

include './admin_verifica.php';
include './db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <li class="nav-item"><a href="admin_relatorio.php" class="nav-link text-white">Relatório</a></li>
        <li class="nav-item mt-3"><a href="logout.php" class="nav-link text-danger">Sair</a></li>
      </ul>
    </aside>

    <!-- Conteúdo -->
    <main class="flex-fill p-4">
    </main>
  </div>
</body>
</html>
