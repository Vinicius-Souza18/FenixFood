<?php
include("admin_verifica.php");
include("db.php");
include("admin_layout.php");
include("admin_nav.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = floatval($_POST["preco"]);
    $categoria = $_POST["categoria"];
    $status = $_POST["status"];
    $imagem_nome = "";

    // Upload da imagem
    if ($_FILES["imagem"]["error"] == 0) {
        $imagem_nome = time() . "_" . basename($_FILES["imagem"]["name"]);
        $caminho_destino = "uploads/" . $imagem_nome;
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_destino);
    }

    // Inserção no banco
    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, categoria, imagem, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss", $nome, $descricao, $preco, $categoria, $imagem_nome, $status);

    if ($stmt->execute()) {
        $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Produto cadastrado com sucesso!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
                </div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erro ao cadastrar: " . $stmt->error . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
                </div>";
    }
}
?>

<div class="content">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="card shadow border-0">
          <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0">Cadastrar Novo Produto</h5>
          </div>
          <div class="card-body">
            <?php echo $msg; ?>
            <form method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
              </div>
              <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
              </div>
              <div class="mb-3">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
              </div>
              <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria" required>
                  <option value="">Selecione</option>
                  <option value="Lanches">Lanches</option>
                  <option value="Bebidas">Bebidas</option>
                  <option value="Almoço">Almoço</option>
                  <option value="Mercado">Mercado</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Produto</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*" onchange="previewImagem(event)">
                <img id="preview" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="ativo">Ativo</option>
                  <option value="inativo">Inativo</option>
                </select>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary">Salvar Produto</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include("admin_rodape.php"); ?>
