<?php
session_start();
include './db.php';

// Buscar produtos do banco
$stmt = $pdo->query("SELECT * FROM produtos ORDER BY categoria, nome");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agrupar por categoria
$categorias = [];
foreach ($produtos as $produto) {
  $categorias[$produto['categoria']][] = $produto;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DeliveryCompleto - Seu delivery premium</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-dark text-white">

  <!-- NAV -->
  <header class="bg-secondary py-3 px-4 d-flex justify-content-between align-items-center">
    <h2 class="text-warning m-0">🍴 DeliveryCompleto</h2>
    <div>
      <?php if (isset($_SESSION['usuario_id'])): ?>
        <a href="./perfil.php" class="btn btn-outline-light me-2"><i class="fas fa-user"></i> <?= $_SESSION['usuario_nome'] ?></a>
        <a class="btn btn-outline-danger me-2" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
        <a href="./meus_pedidos.php" class="btn btn-outline-info me-2">Meus Pedidos</a>
       

      <?php else: ?>
        <a href="./login.php" class="btn btn-outline-light me-2"><i class="fas fa-user"></i> Entrar</a>
      <?php endif; ?>
      <a href="./carrinho.php" class="btn btn-warning"><i class="fas fa-shopping-cart"></i> Carrinho</a>




    </div>
  </header>

  <!-- HERO -->
  <section class="hero text-center p-5 bg-dark text-white">
    <h1 class="display-5 fw-bold mb-3">Sabor e <span class="text-warning">qualidade</span> direto na sua casa</h1>
    <p class="lead">Faça seu pedido agora e receba com rapidez e excelência</p>
    <a href="#cardapio" class="btn btn-warning btn-lg mt-3">Ver Cardápio</a>
  </section>

  <!-- PRODUTOS POR CATEGORIA -->
  <main class="container py-5" id="cardapio">
    <?php if (empty($categorias)): ?>
      <div class="alert alert-warning">Nenhum produto disponível no momento.</div>
    <?php else: ?>
      <?php foreach ($categorias as $categoria => $itens): ?>
        <h2 class="text-info border-bottom pb-2 mb-4 mt-5"><?= htmlspecialchars($categoria) ?></h2>
        <div class="row g-4">
          <?php foreach ($itens as $p): ?>
            <div class="col-md-3 col-sm-6">
              <div class="card h-100">
                <img src="<?= $p['imagem'] ?>" class="card-img-top" alt="<?= $p['nome'] ?>" style="height: 180px; object-fit: cover;">
                <div class="card-body text-dark d-flex flex-column">
                  <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                  <p class="mb-1 text-muted"><?= htmlspecialchars($p['categoria']) ?></p>
                  <p class="fw-bold mb-2">R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
                  <form action="carrinho.php" method="POST" class="mt-auto">
                    <input type="hidden" name="id_produto" value="<?= $p['id'] ?>">
                    <input type="hidden" name="quantidade" value="1">
                    <button type="submit" name="adicionar" class="btn btn-sm btn-warning w-100">
                      <i class="fas fa-cart-plus"></i> Adicionar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </main>

  <!-- RODAPÉ -->
  <footer class="bg-secondary text-center text-white py-4 mt-5">
    <p class="mb-1">© <?= date('Y') ?> DeliveryCompleto. Todos os direitos reservados.</p>
    <small>Desenvolvido com ❤️ para uma experiência premium de delivery.</small>
  </footer>

</body>

</html>