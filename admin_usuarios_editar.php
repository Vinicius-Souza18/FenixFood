<?php
include './admin_verifica.php';
include './db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header("Location: admin_usuarios.php");
    exit;
}

$id = $_GET['id'];

// Busca os dados do usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar, redireciona
if (!$usuario) {
    header("Location: admin_usuarios.php");
    exit;
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Atualiza o usuário
    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $telefone, $endereco, $id]);

    header("Location: admin_usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-dark text-white">
    <div class="container py-5">
        <h2 class="text-warning mb-4"><i class="fas fa-user-edit"></i> Editar Usuário</h2>
        <form method="POST" class="bg-secondary p-4 rounded">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($usuario['telefone']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" value="<?= htmlspecialchars($usuario['endereco']) ?>" required>
            </div>

            <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Salvar Alterações</button>
            <a href="admin_usuarios.php" class="btn btn-light ms-2">Cancelar</a>
        </form>
    </div>
</body>
</html>
