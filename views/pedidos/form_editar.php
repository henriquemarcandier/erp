<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Editar Pedido #<?= $pedido['id'] ?></h3>
  <form method="POST" action="?url=pedidos/atualizar">
    <input type="hidden" name="id" value="<?= $pedido['id'] ?>">

    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-select" required>
        <?php
          $status_options = ['Pendente', 'Processando', 'Enviado', 'Cancelado', 'Concluído'];
          foreach ($status_options as $opt) {
            $sel = ($pedido['status'] == $opt) ? 'selected' : '';
            echo "<option value=\"$opt\" $sel>$opt</option>";
          }
        ?>
      </select>
    </div>

    <div class="mb-3">
  <label>CEP</label>
  <input type="text" name="cep" id="cep" class="form-control" value="<?= htmlspecialchars($pedido['cep']) ?>" required>
</div>

<div class="mb-3">
  <label>Endereço</label>
  <textarea name="endereco" id="endereco" class="form-control" required><?= htmlspecialchars($pedido['endereco']) ?></textarea>
</div>

<script>
document.getElementById('cep').addEventListener('blur', function() {
  const cep = this.value.replace(/\D/g, '');
  if (cep.length === 8) {
    fetch('https://viacep.com.br/ws/' + cep + '/json/')
      .then(response => response.json())
      .then(data => {
        if (!data.erro) {
          const endereco = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
          document.getElementById('endereco').value = endereco;
        } else {
          alert('CEP não encontrado.');
        }
      })
      .catch(() => alert('Erro ao buscar o CEP.'));
  }
});
</script>

    <div class="mb-3">
      <label>E-mail do Cliente</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($pedido['email_cliente']) ?>" required>
    </div>

    <h5 class="mt-4">Produtos no Pedido</h5>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Produto</th>
          <th>Variação</th>
          <th>Quantidade</th>
          <th>Preço Unitário</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($itens as $item): ?>
        <tr>
          <td><?= htmlspecialchars($item['produto_nome']) ?></td>
          <td><?= htmlspecialchars($item['variacao_nome']) ?></td>
          <td><?= $item['quantidade'] ?></td>
          <td>R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
          <td>R$ <?= number_format($item['quantidade'] * $item['preco_unitario'], 2, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <button type="submit" class="btn btn-primary mt-3">Atualizar Pedido</button>
  </form>
  <a href="?url=pedidos" class="btn btn-secondary mt-3">Voltar</a>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
