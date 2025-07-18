<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Editar Produto</h3>
  <form method="POST" action="?url=produtos/atualizar">
    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
    <div class="mb-3">
      <label>Nome do Produto</label>
      <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Preço</label>
      <input type="number" step="0.01" name="preco" class="form-control" value="<?= $produto['preco'] ?>" required>
    </div>
    <h5>Variações</h5>
    <div id="variacoes">
      <?php foreach ($variacoes as $i => $var): ?>
      <div class="row mb-2">
        <input type="hidden" name="variacoes[<?= $i ?>][id]" value="<?= $var['id'] ?>">
        <div class="col">
          <input type="text" name="variacoes[<?= $i ?>][nome]" value="<?= htmlspecialchars($var['nome']) ?>" placeholder="Nome da variação" class="form-control" required>
        </div>
        <div class="col">
          <input type="number" name="variacoes[<?= $i ?>][estoque]" value="<?= $var['quantidade'] ?>" placeholder="Estoque" class="form-control" required>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Produto</button>
  </form>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
