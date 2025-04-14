<?php

include 'admin_layout.php';
include './db.php';

$dataAtual = date('Y-m');

$stmt = $pdo->prepare("
  SELECT COUNT(*) AS total_pedidos, SUM(preco_total) AS total_faturado 
  FROM pedidos 
  WHERE DATE_FORMAT(data_pedido, '%Y-%m') = ?
");
$stmt->execute([$dataAtual]);
$dados = $stmt->fetch(PDO::FETCH_ASSOC);

$totalPedidos = $dados['total_pedidos'] ?? 0;
$totalFaturado = $dados['total_faturado'] ?? 0.00;
?>

<h2 class="mb-4">Relatório do Mês (<?= date('m/Y') ?>)</h2>

<div class="row g-4">
  <div class="col-md-6">
    <div class="card bg-info text-dark text-center p-4">
      <h4>Total de Pedidos</h4>
      <p class="fs-3"><?= $totalPedidos ?></p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card bg-success text-white text-center p-4">
      <h4>Faturamento Total</h4>
      <p class="fs-3">R$ <?= number_format($totalFaturado, 2, ',', '.') ?></p>
    </div>
  </div>
</div>

<?php include 'admin_rodape.php'; ?>
