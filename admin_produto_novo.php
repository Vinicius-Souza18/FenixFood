<?php
include './admin_verifica.php';
include './db.php';

// Ao enviar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $preco = $_POST['preco'];
  $descricao = $_POST['descricao'];
  $categoria = $_POST['categoria'];

  // Upload da imagem
  $nomeImagem = '';
  if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $nomeImagem = uniqid() . "." . $ext;
    move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/" . $nomeImagem);
  }

  // Inserção no banco
  $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, descricao, categoria, imagem) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$nome, $preco, $descricao, $categoria, $nomeImagem]);

  header("Location: admin_produtos.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Novo Produto - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">
  <div class="d-flex">
    <aside class="bg-secondary p-3 vh-100" style="width: 250px;">
      <h4 class="text-warning mb-4">Delivery Admin</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">Dashboard</a></li>
        <li class="nav-item"><a href="admin_produtos.php" class="nav-link text-white">Produtos</a></li>
        <li class="nav-item"><a href="admin_produto_novo.php" class="nav-link active text-warning fw-bold">Novo Produto</a></li>
        <li class="nav-item"><a href="admin_pedidos.php" class="nav-link text-white">Pedidos</a></li>
        <li class="nav-item"><a href="admin_usuarios.php" class="nav-link text-white">Clientes</a></li>
        <li class="nav-item"><a href="admin_relatorio.php" class="nav-link text-white">Relatório</a></li>
        <li class="nav-item mt-3"><a href="logout.php" class="nav-link text-danger">Sair</a></li>
      </ul>
    </aside>

    <main class="flex-fill p-4">
      <div class="container">
        <h3 class="text-warning mb-4"><i class="fas fa-plus-circle"></i> Novo Produto</h3>

        <form method="POST" enctype="multipart/form-data" class="bg-secondary p-4 rounded shadow">
          <div class="mb-3">
            <label class="form-label">Nome do Produto</label>
            <input type="text" name="nome" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Preço (R$)</label>
            <input type="number" name="preco" step="0.01" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria" class="form-select" required>
              <option value="Lanches">Lanches</option>
              <option value="Bebidas">Bebidas</option>
              <option value="Almoço">Almoço</option>
              <option value="Mercado">Mercado</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Imagem do Produto</label>
            <input type="file" name="imagem" class="form-control" accept="image/*" required>
          </div>

          <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Cadastrar Produto</button>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
