<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Pedidos</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Cliente (E-mail)</th>
        <th>Subtotal (R$)</th>
        <th>Frete (R$)</th>
        <th>Desconto (R$)</th>
        <th>Valor Total (R$)</th>
        <th>CEP</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pedidos as $pedido): ?>
      <tr>
        <td><?= $pedido['id'] ?></td>
        <td><?= htmlspecialchars($pedido['email_cliente']) ?></td>
        <td><?= number_format($pedido['subtotal'], 2, ',', '.') ?></td>
        <td><?= number_format($pedido['frete'], 2, ',', '.') ?></td>
        <td><?= number_format($pedido['desconto'], 2, ',', '.') ?></td>
        <td><?= number_format($pedido['total'], 2, ',', '.') ?></td>
        <td><?= htmlspecialchars($pedido['cep']) ?></td>
        <td><?= htmlspecialchars($pedido['status'] ?? 'Pendente') ?></td>
        <td><?= date('d/m/Y H:i', strtotime($pedido['criado_em'] ?? $pedido['data'])) ?></td>
        <td><a href="?url=pedido/editar&id=<?= $pedido['id'] ?>" class="btn btn-sm btn-success">Editar</a> <a href="?url=pedido/detalhes&id=<?= $pedido['id'] ?>" class="btn btn-sm btn-primary">Detalhes</a>
        <a href="?url=pedido/excluir&id=<?= $pedido['id'] ?>" 
        class="btn btn-sm btn-danger"
        onclick="return confirm('Tem certeza que deseja excluir este pedido?');">
        Excluir
        </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
