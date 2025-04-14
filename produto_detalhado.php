<?php
include './db.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    echo "<p>Produto não encontrado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($produto['nome']) ?> | Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

  <div class="container py-5">
    <a href="index.php" class="btn btn-outline-light mb-4">← Voltar</a>

    <div class="row">
      <div class="col-md-6">
        <img src="<?= $produto['imagem'] ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" class="img-fluid rounded">
      </div>
      <div class="col-md-6">
        <h1><?= htmlspecialchars($produto['nome']) ?></h1>
        <h4 class="text-warning">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></h4>
        <p class="mt-3">Categoria: <strong><?= htmlspecialchars($produto['categoria']) ?></strong></p>

        <form action="carrinho.php" method="POST" class="mt-4">
          <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
          <div class="mb-3">
            <label>Quantidade:</label>
            <input type="number" name="quantidade" class="form-control w-25" value="1" min="1" required>
          </div>
          <button type="submit" name="adicionar" class="btn btn-success">
            <i class="fas fa-cart-plus"></i> Adicionar ao carrinho
          </button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
