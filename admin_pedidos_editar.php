<?php
include './admin_verifica.php';
include './db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header("Location: admin_pedidos.php");
    exit;
}

$id = $_GET['id'];

// Busca os dados do pedido
$stmt = $pdo->prepare("SELECT * FROM pedidos WHERE id = ?");
$stmt->execute([$id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar, redireciona
if (!$pedido) {
    header("Location: admin_pedidos.php");
    exit;
}

// Busca os status disponíveis do banco
$stmtStatus = $pdo->query("SELECT * FROM status_pedido");
$statusList = $stmtStatus->fetchAll(PDO::FETCH_ASSOC);

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $produto = $_POST['produto'];
    $status = $_POST['status'];
    $data_pedido = $_POST['data_pedido'];
    $preco_total = $_POST['preco_total'];

    // Atualiza o pedido
    $stmt = $pdo->prepare("UPDATE pedidos SET usuario_id = ?, produto = ?, status = ?, data_pedido = ?, preco_total = ? WHERE id = ?");
    $stmt->execute([$usuario_id, $produto, $status, $data_pedido, $preco_total, $id]);

    header("Location: admin_pedidos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-dark text-white">
    <div class="container py-5">
        <h2 class="text-warning mb-4"><i class="fas fa-edit"></i> Editar Pedido</h2>

        <form method="POST" class="bg-secondary p-4 rounded">
            <div class="mb-3">
                <label class="form-label">ID do Usuário</label>
                <input type="number" name="usuario_id" class="form-control" value="<?= htmlspecialchars($pedido['usuario_id']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Produto(s)</label>
                <textarea name="produto" class="form-control" rows="3" required><?= htmlspecialchars($pedido['produto']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Preço Total (R$)</label>
                <input type="number" name="preco_total" class="form-control" step="0.01" value="<?= htmlspecialchars($pedido['preco_total']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <?php foreach ($statusList as $status): ?>
                        <option value="<?= $status['nome'] ?>" <?= $pedido['status'] === $status['nome'] ? 'selected' : '' ?>>
                            <?= ucfirst($status['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Data do Pedido</label>
                <input type="text" name="data_pedido" class="form-control" value="<?= htmlspecialchars($pedido['data_pedido']) ?>" required>
            </div>

            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Salvar Alterações</button>
            <a href="admin_pedidos.php" class="btn btn-light ms-2">Cancelar</a>
        </form>
    </div>
</body>
</html>
