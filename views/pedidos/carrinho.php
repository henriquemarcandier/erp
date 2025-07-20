<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Carrinho de Compras</h3>
  <?php if (empty($_SESSION['carrinho'])): ?>
    <div class="alert alert-warning">Carrinho vazio.</div>
  <?php else: ?>
    <table class="table table-bordered">
      <thead><tr><th>Produto</th><th>Variação</th><th>Preço</th><th>Ação</th></tr></thead>
      <tbody>
      <?php $subtotal = 0;
      foreach ($_SESSION['carrinho'] as $i => $item):
        $subtotal += $item['preco']; ?>
        <tr>
          <td><?= $item['produto'] ?></td>
          <td><?= $item['variacao'] ?></td>
          <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
          <td><a href="?url=carrinho/remover&i=<?= $i ?>" class="btn btn-sm btn-danger">Remover</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <form method="POST" action="?url=carrinho">
      <div class="mb-3">
        <label>Cupom de Desconto</label>
        <input type="text" name="cupom" class="form-control" value="<?= $_SESSION['cupom_aplicado'] ?? '' ?>">
        <button type="submit" class="btn btn-sm btn-outline-primary mt-1">Aplicar Cupom</button>
      </div>
    </form>
    <?php
      $frete = ($subtotal >= 52 && $subtotal <= 166.59) ? 15 : (($subtotal > 200) ? 0 : 20);
      $desconto = $_SESSION['valor_desconto'] ?? 0;
      $total = $subtotal + $frete - $desconto;
      $total = ($total > 0) ? $total : 0;
    ?>
    <p><strong>Subtotal:</strong> R$ <?= number_format($subtotal, 2, ',', '.') ?></p>
    <p><strong>Frete:</strong> R$ <?= number_format($frete, 2, ',', '.') ?></p>
    <?php if ($desconto > 0): ?>
      <p><strong>Desconto aplicado:</strong> -R$ <?= number_format($desconto, 2, ',', '.') ?></p>
    <?php endif; ?>
    <p><strong>Total:</strong> R$ <?= number_format($total, 2, ',', '.') ?></p>
    <?php if (isset($_SESSION['mensagem_cupom'])): ?>
      <div class="alert alert-info"><?= $_SESSION['mensagem_cupom'] ?></div>
    <?php unset($_SESSION['mensagem_cupom']); endif; ?>
    <form method="POST" action="?url=pedido/finalizar">
      <div class="mb-2"><label>CEP</label><input type="text" name="cep" class="form-control" id="cep" required></div>
      <div class="mb-2"><label>Endereço</label><input type="text" name="endereco" class="form-control" id="endereco" required></div>
      <div class="mb-2"><label>E-mail</label><input type="email" name="email" class="form-control" required></div>
      <button type="submit" class="btn btn-success">Finalizar Pedido</button>
    </form>
  <?php endif; ?>
</div>
<script>
document.getElementById('cep')?.addEventListener('blur', function () {
  let cep = this.value.replace(/\D/g, '');
  if (cep.length === 8) {
    fetch('https://viacep.com.br/ws/' + cep + '/json/')
      .then(res => res.json())
      .then(data => {
        if (!data.erro) {
          document.getElementById('endereco').value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
        }
      });
  }
});
</script>
<?php include __DIR__ . '/../layout/footer.php'; ?>