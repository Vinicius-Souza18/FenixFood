<?php
include './admin_verifica.php';
include './db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Clientes - Painel Admin</title>
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
        <li class="nav-item"><a href="admin_usuarios.php" class="nav-link active text-warning fw-bold">Clientes</a></li>
        <li class="nav-item"><a href="admin_relatorio.php" class="nav-link text-white">Relatório</a></li>
        <li class="nav-item mt-3"><a href="logout.php" class="nav-link text-danger">Sair</a></li>
      </ul>
    </aside>

    <!-- Conteúdo -->
    <main class="flex-fill p-4">
      <div class="container-fluid">
        <h3 class="text-warning mb-4"><i class="fas fa-users"></i> Clientes Cadastrados</h3>

        <div class="table-responsive bg-dark rounded shadow p-3">
          <table class="table table-dark table-hover table-bordered align-middle">
            <thead class="table-secondary text-dark">
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Data Cadastro</th>
                <th>Acões</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY criado_em DESC");
              while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr>
                  <td><?= $usuario['id'] ?></td>
                  <td><?= $usuario['nome'] ?></td>
                  <td><?= $usuario['email'] ?></td>
                  <td><?= $usuario['telefone'] ?></td>
                  <td><?= $usuario['endereco'] ?></td>
                  <td><?= date('d/m/Y H:i', strtotime($usuario['criado_em'])) ?></td>
                  <td>
                    <a href="admin_usuarios_editar.php?id=<?= $usuario['id'] ?>" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="admin_usuarios_excluir.php?id=<?= $usuario['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este pedido?')">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
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
