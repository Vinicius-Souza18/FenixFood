<?php
require './admin_verifica.php';
require './db.php';

header('Content-Type: application/json');

try {
  $stmt = $pdo->query("SELECT SUM(preco_total) AS total FROM pedidos");
  $res = $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode(['total' => number_format($res['total'], 2, ',', '.')]);
} catch (PDOException $e) {
  echo json_encode(['erro' => 'Erro ao buscar faturamento']);
}
