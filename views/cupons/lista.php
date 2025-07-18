<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Cupons</h3>
  <a href="?url=cupons/novo" class="btn btn-primary mb-3">Novo Cupom</a>
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
