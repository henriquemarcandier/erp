<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Produtos</h3>
  <a href="?url=produtos/novo" class="btn btn-primary mb-3">Novo Produto</a>
  <table class="table table-bordered">
    <thead>
      <tr><th>ID</th><th>Nome</th><th>Preço</th><th>Ação</th></tr>
    </thead>
    <tbody>
      <?php foreach($produtos as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= $p['nome'] ?></td>
          <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
          <td><a href="?url=produtos/comprar&id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Comprar</a> <a href="?url=produtos/editar&id=<?= $p['id'] ?>" class="btn btn-sm btn-success">Editar</a> <a href="?url=produtos/excluir&id=<?= $produto['id'] ?>" 
   class="btn btn-sm btn-danger" 
   onclick="return confirm('Tem certeza que deseja excluir este produto?')">
   Excluir
</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
