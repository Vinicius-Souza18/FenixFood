<?php
session_start();
include './db.php';

// Inicializa o carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

// Adicionar item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
  $id = (int) $_POST['id_produto'];
  $qtd = (int) $_POST['quantidade'];
  if ($qtd < 1) $qtd = 1;

  if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id] += $qtd;
  } else {
    $_SESSION['carrinho'][$id] = $qtd;
  }

  header("Location: carrinho.php");
  exit;
}

// Remover item
if (isset($_GET['remover'])) {
  unset($_SESSION['carrinho'][(int)$_GET['remover']]);
  header("Location: carrinho.php");
  exit;
}

// Buscar produtos no carrinho
$produtos = [];
$total = 0;

if (!empty($_SESSION['carrinho'])) {
  $ids = implode(',', array_keys($_SESSION['carrinho']));
  $stmt = $pdo->query("SELECT * FROM produtos WHERE id IN ($ids)");
  $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Meu Carrinho | DeliveryCompleto</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container py-5">
  <h2 class="mb-4">🛒 Seu Carrinho</h2>

  <?php if (empty($_SESSION['carrinho'])): ?>
    <div class="alert alert-warning">Seu carrinho está vazio.</div>
    <a href="index.php" class="btn btn-outline-light">Voltar para o cardápio</a>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle">
        <thead class="table-secondary text-dark">
          <tr>
            <th>Produto</th>
            <th>Qtd</th>
            <th>Preço</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($produtos as $p): 
            $qtd = $_SESSION['carrinho'][$p['id']];
            $subtotal = $p['preco'] * $qtd;
            $total += $subtotal;
          ?>
          <tr>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= $qtd ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
            <td>
              <a href="?remover=<?= $p['id'] ?>" class="btn btn-sm btn-danger">Remover</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="text-end mt-3">
      <h4>Total: <span class="text-warning">R$ <?= number_format($total, 2, ',', '.') ?></span></h4>
      <a href="finalizar_pedido.php" class="btn btn-success mt-3">Finalizar Pedido</a>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
