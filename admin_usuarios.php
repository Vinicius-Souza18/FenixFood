<?php
include 'admin_layout.php';
include './db.php';

// Buscar clientes
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY nome");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="mb-4">Clientes Cadastrados</h2>

<?php if (count($usuarios) > 0): ?>
  <div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
      <thead class="table-secondary text-dark">
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Telefone</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nome']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['telefone']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <div class="alert alert-warning">Nenhum cliente encontrado.</div>
<?php endif; ?>

<?php include 'admin_rodape.php'; ?>
