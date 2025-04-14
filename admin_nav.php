<?php
// Garante que a sessão esteja ativa
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-4 py-3">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-warning" href="admin_dashboard.php">Painel Admin</a>

    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="admin_dashboard.php">📊 Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_produto_novo.php">➕ Novo Produto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_produtos.php">📦 Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_pedidos.php">🧾 Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="admin_logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
