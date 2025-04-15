<?php
include './admin_verifica.php';
include './db.php';

if (!isset($_GET['id'])) {
  header("Location: admin_produtos.php");
  exit;
}

$id = $_GET['id'];

// Busca o produto
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
  header("Location: admin_produtos.php");
  exit;
}

// Se confirmou exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Exclui imagem se existir
  if (!empty($produto['imagem']) && file_exists("uploads/" . $produto['imagem'])) {
    unlink("uploads/" . $produto['imagem']);
  }

  // Exclui do banco
  $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
  $stmt->execute([$id]);

  header("Location: admin_produtos.php?excluido=1");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <div class="bg-secondary p-4 rounded text-center">
      <h2 class="text-danger mb-4"><i class="fas fa-trash-alt"></i> Excluir Produto</h2>
      <p class="fs-5">Tem certeza que deseja excluir o produto:</p>
      <h4 class="text-warning"><?= htmlspecialchars($produto['nome']) ?></h4>
      <img src="uploads/<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem" class="img-thumbnail my-3" width="180">

      <form method="POST">
        <button type="submit" class="btn btn-danger px-4">Sim, excluir</button>
        <a href="admin_produtos.php" class="btn btn-light px-4">Cancelar</a>
      </form>
    </div>
  </div>
</body>
</html>
