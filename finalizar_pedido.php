<?php
session_start();
include 'db.php';

// Verifica se o cliente está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Verifica se há produtos no carrinho
if (empty($_SESSION['carrinho'])) {
    header("Location: carrinho.php");
    exit;
}

// Busca os produtos do carrinho
$ids = implode(',', array_keys($_SESSION['carrinho']));
$stmt = $pdo->query("SELECT * FROM produtos WHERE id IN ($ids)");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcula o total
$total = 0;
foreach ($produtos as $produto) {
    $qtd = $_SESSION['carrinho'][$produto['id']];
    $total += $produto['preco'] * $qtd;
}

// Insere o pedido no banco
$stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, preco_total, criado_em) VALUES (?, ?, NOW())");
$stmt->execute([$_SESSION['usuario_id'], $total]);

// Opcional: obter o ID do pedido recém-criado, se quiser usar depois
// $pedido_id = $pdo->lastInsertId();

// Limpa o carrinho
unset($_SESSION['carrinho']);

// Redireciona para a página de sucesso
header("Location: pedido_sucesso.php");
exit;
