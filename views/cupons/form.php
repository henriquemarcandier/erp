<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Novo Cupom</h3>
  <form method="POST" action="?url=cupons/salvar">
    <div class="mb-3">
      <label>Código</label>
      <input type="text" name="codigo" class="form-control" required maxlength="50" style="text-transform: uppercase;">
    </div>
    <div class="mb-3">
      <label>Valor do Desconto (R$)</label>
      <input type="number" step="0.01" name="valor_desconto" class="form-control" required min="0">
    </div>
    <div class="mb-3">
      <label>Valor Mínimo do Pedido (R$)</label>
      <input type="number" step="0.01" name="minimo_pedido" class="form-control" required min="0">
    </div>
    <div class="mb-3">
      <label>Validade</label>
      <input type="date" name="validade" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Cupom</button>
  </form>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
