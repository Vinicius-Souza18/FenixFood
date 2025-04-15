<?php
include './admin_verifica.php';
include './db.php';

$stmt = $pdo->query("SELECT * FROM produtos ORDER BY criado_em DESC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Produtos - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="d-flex">
    <!-- Sidebar -->
    <aside class="bg-secondary p-3 vh-100" style="width: 250px;">
      <h4 class="text-warning mb-4">Delivery Admin</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">Dashboard</a></li>
        <li class="nav-item"><a href="admin_produtos.php" class="nav-link active text-warning fw-bold">Produtos</a></li>
        <li class="nav-item"><a href="admin_produto_novo.php" class="nav-link text-white">Novo Produto</a></li>
        <li class="nav-item"><a href="admin_pedidos.php" class="nav-link text-white">Pedidos</a></li>
        <li class="nav-item"><a href="admin_usuarios.php" class="nav-link text-white">Clientes</a></li>
        <li class="nav-item"><a href="admin_relatorio.php" class="nav-link text-white">Relatório</a></li>
        <li class="nav-item mt-3"><a href="logout.php" class="nav-link text-danger">Sair</a></li>
      </ul>
    </aside>

    <main class="flex-fill p-4">
      <div class="container">
        <h3 class="text-warning mb-4"><i class="fas fa-box"></i> Produtos</h3>

        <a href="admin_produto_novo.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Novo Produto</a>

        <div class="table-responsive">
          <table class="table table-bordered table-hover text-white">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($produtos as $produto): ?>
                <tr>
                  <td><?= $produto['id'] ?></td>
                  <td><img src="uploads/<?= $produto['imagem'] ?>" width="60" class="rounded"></td>
                  <td><?= $produto['nome'] ?></td>
                  <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                  <td><?= $produto['categoria'] ?></td>
                  <td>
                    <a href="admin_produto_editar.php?id=<?= $produto['id'] ?>" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="admin_produto_excluir.php?id=<?= $produto['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
