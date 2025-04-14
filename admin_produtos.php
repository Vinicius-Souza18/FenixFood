<?php
include 'admin_layout.php';
include './db.php';

// Buscar produtos
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY criado_em DESC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="mb-4">Produtos</h2>

<a href="admin_produto_novo.php" class="btn btn-success mb-3">+ Novo Produto</a>

<?php if (count($produtos) > 0): ?>
  <div class="table-responsive">
    <table class="table table-dark table-striped table-hover">
      <thead class="table-secondary text-dark">
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Preço</th>
          <th>Criado em</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($produtos as $p): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['categoria']) ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= date('d/m/Y', strtotime($p['criado_em'])) ?></td>
            <td>
              <a href="admin_editar_produto.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="admin_excluir_produto.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <div class="alert alert-warning">Nenhum produto cadastrado.</div>
<?php endif; ?>

<?php include 'admin_rodape.php'; ?>
