<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Cupons</h3>
  <a href="?url=cupons/novo" class="btn btn-primary mb-3">Novo Cupom</a>
  <a href="#" class="btn btn-success mb-3" onclick="if (document.getElementById('filtrar').style.display == 'none'){ document.getElementById('filtrar').style.display='block'; } else{ document.getElementById('filtrar').style.display='none'; }">Filtrar</a>
  <div id="filtrar" style="display: none;">
    <form action="?url=cupons" method="get" class="form-inline mb-3">
      <input type="hidden" name="url" value="cupons">
      <div class="form-group mr-2">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo" class="form-control ml-2" value="<?= isset($_GET['codigo']) ? htmlspecialchars($_GET['codigo']) : '' ?>">
      </div>
      <div class="form-group mr-2">
        <label for="validade">Validade:</label>
        <input type="date" name="validade" id="validade" class="form-control ml-2" value="<?= isset($_GET['validade']) ? htmlspecialchars($_GET['validade']) : '' ?>">
      </div>
      <button type="submit" class="btn btn-primary">Filtrar</button>
      <a href="?url=cupons" class="btn btn-secondary ml-2">Fechar</a>
    </form>
  </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Código</th>
        <th>Desconto (R$)</th>
        <th>Mínimo do Pedido (R$)</th>
        <th>Validade</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cupons as $cupom): ?>
      <tr>
        <td><?= htmlspecialchars($cupom['codigo']) ?></td>
        <td><?= number_format($cupom['valor_desconto'], 2, ',', '.') ?></td>
        <td><?= number_format($cupom['minimo_pedido'], 2, ',', '.') ?></td>
        <td><?= date('d/m/Y', strtotime($cupom['validade'])) ?></td>
        <td>
        <a href="?url=cupons/editar&id=<?= $cupom['id'] ?>" class="btn btn-sm btn-success">Editar</a>
        <a href="?url=cupons/deletar&id=<?= $cupom['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este cupom?')">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
