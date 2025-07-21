<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Detalhes do Pedido #<?= $pedido['id'] ?></h3>
  <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['email_cliente']) ?></p>
  <p><strong>CEP:</strong> <?= htmlspecialchars($pedido['cep']) ?></p>
  <p><strong>Endereço:</strong> <?= htmlspecialchars($pedido['endereco']) ?></p>
  <p><strong>Subtotal:</strong> R$ <?= number_format($pedido['subtotal'], 2, ',', '.') ?></p>
  <p><strong>Frete:</strong> R$ <?= number_format($pedido['frete'], 2, ',', '.') ?></p>
  <p><strong>Desconto:</strong> R$ <?= number_format($pedido['desconto'], 2, ',', '.') ?></p>
  <p><strong>Total:</strong> R$ <?= number_format($pedido['total'], 2, ',', '.') ?></p>
  <p><strong>Status:</strong> <?= htmlspecialchars($pedido['status'] ?? 'Pendente') ?></p>
  <h5>Itens:</h5>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Variação</th>
        <th>Quantidade</th>
        <th>Preço Unitário (R$)</th>
        <th>Subtotal (R$)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($itens as $item): ?>
      <tr>
        <td><?= htmlspecialchars($item['produto_nome']) ?></td>
        <td><?= htmlspecialchars($item['variacao_nome']) ?></td>
        <td><?= $item['quantidade'] ?></td>
        <td><?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
        <td><?= number_format($item['quantidade'] * $item['preco_unitario'], 2, ',', '.') ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="?url=pedidos" class="btn btn-secondary">Voltar</a>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
