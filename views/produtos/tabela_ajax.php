<?php if (empty($produtos)): ?>
  <div class="alert alert-warning">Nenhum produto encontrado.</div>
<?php else: ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($produtos as $produto): ?>
        <tr>
          <td><?= htmlspecialchars($produto['nome']) ?></td>
          <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
          <td><?= $produto['estoque'] ?></td>
          <td>
            <button class="btn btn-sm btn-warning btn-editar" data-id="<?= $produto['id'] ?>">Editar</button>
            <button class="btn btn-sm btn-danger btn-excluir" data-id="<?= $produto['id'] ?>">Excluir</button>
            <a href="/public/index.php?pagina=pedidos&acao=comprar&id=<?= $produto['id'] ?>" class="btn btn-sm btn-success">Comprar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>