<?php
include './admin_verifica.php';
include './db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
  header("Location: admin_produtos.php");
  exit;
}

$id = $_GET['id'];

// Busca os dados do produto
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar, redireciona
if (!$produto) {
  header("Location: admin_produtos.php");
  exit;
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $categoria = $_POST['categoria'];
  
  // Upload de imagem (opcional)
  if (!empty($_FILES['imagem']['name'])) {
    $imagem_nome = uniqid() . "_" . $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/" . $imagem_nome);
  } else {
    $imagem_nome = $produto['imagem'];
  }

  // Atualiza o banco
  $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, categoria = ?, imagem = ? WHERE id = ?");
  $stmt->execute([$nome, $descricao, $preco, $categoria, $imagem_nome, $id]);

  header("Location: admin_produtos.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2 class="text-warning mb-4"><i class="fas fa-edit"></i> Editar Produto</h2>

    <form method="POST" enctype="multipart/form-data" class="bg-secondary p-4 rounded">
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control" rows="3"><?= htmlspecialchars($produto['descricao']) ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Preço (R$)</label>
        <input type="number" name="preco" class="form-control" step="0.01" value="<?= htmlspecialchars($produto['preco']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Categoria</label>
        <input type="text" name="categoria" class="form-control" value="<?= htmlspecialchars($produto['categoria']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Imagem (opcional)</label><br>
        <img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem atual" width="150" class="mb-2 rounded"><br>
        <input type="file" name="imagem" class="form-control">
      </div>
      <button type="submit" class="btn btn-warning">Salvar Alterações</button>
      <a href="admin_produtos.php" class="btn btn-light">Cancelar</a>
    </form>
  </div>
</body>
</html>
