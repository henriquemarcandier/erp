<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Produtos</h3>
  <a href="?url=produtos/novo" class="btn btn-primary mb-3">Novo Produto</a>
  <a href="#" class="btn btn-success mb-3" onclick="if (document.getElementById('filtrar').style.display == 'none'){ document.getElementById('filtrar').style.display='block'; } else{ document.getElementById('filtrar').style.display='none'; }">Filtrar</a>
  <div id="filtrar" style="display: none;">
    <form action="?url=produtos/listar" method="get" class="form-inline mb-3">
      <input type="hidden" name="url" value="produtos/listar">
      <div class="form-group mr-2">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control ml-2" value="<?= isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : '' ?>">
      </div>
      <div class="form-group mr-2">
        <label for="preco">Preço:</label>
        <input type="number" step="0.01" name="preco" id="preco" class="form-control ml-2" value="<?= isset($_GET['preco']) ? htmlspecialchars($_GET['preco']) : '' ?>">
      </div>
      <button type="submit" class="btn btn-primary">Filtrar</button>
      <a href="#" class="btn btn-secondary ml-2" onclick="document.getElementById('filtrar').style.display = 'none';">Fechar</a>
    </form>
  </div>
  <?php if (count($produtos)){?>
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
          <td><a href="?url=produtos/comprar&id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Comprar</a> <a href="?url=produtos/editar&id=<?= $p['id'] ?>" class="btn btn-sm btn-success">Editar</a> <a href="?url=produtos/excluir&id=<?= $p['id'] ?>" 
   class="btn btn-sm btn-danger" 
   onclick="return confirm('Tem certeza que deseja excluir este produto?')">
   Excluir
</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php }
  else{
   ?><br><br><div style="text-align:center"><div class="alert alert-warning">Sem nenhum registro encontrado!</div></div><?php 
  }?>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
