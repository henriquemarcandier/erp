<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Editar Cupom</h3>
  <form method="POST" action="?url=cupons/atualizar">
    <input type="hidden" name="id" value="<?= $cupom['id'] ?>">
    <div class="mb-3">
      <label>Código</label>
      <input type="text" name="codigo" class="form-control" required maxlength="50" style="text-transform: uppercase;" value="<?= htmlspecialchars($cupom['codigo']) ?>">
    </div>
    <div class="mb-3">
      <label>Valor do Desconto (R$)</label>
      <input type="number" step="0.01" name="valor_desconto" class="form-control" required min="0" value="<?= $cupom['valor_desconto'] ?>">
    </div>
    <div class="mb-3">
      <label>Valor Mínimo do Pedido (R$)</label>
      <input type="number" step="0.01" name="minimo_pedido" class="form-control" required min="0" value="<?= $cupom['minimo_pedido'] ?>">
    </div>
    <div class="mb-3">
      <label>Validade</label>
      <input type="date" name="validade" class="form-control" required value="<?= $cupom['validade'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Cupom</button>
  </form>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
