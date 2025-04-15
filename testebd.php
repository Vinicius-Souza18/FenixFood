<?php
require 'db.php';

$inicio = microtime(true);

$stmt = $pdo->query("SELECT SUM(preco_total) AS total FROM pedidos");
$total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

$fim = microtime(true);
$tempo = $fim - $inicio;

echo "Total: R$ " . number_format($total, 2, ',', '.');
echo "<br>Tempo de execução: " . round($tempo, 4) . " segundos";
