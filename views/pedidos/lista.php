<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Pedidos</h3>
  <a href="#" class="btn btn-primary mb-3" onclick="if (document.getElementById('filtrar').style.display == 'none'){ document.getElementById('filtrar').style.display='block'; } else{ document.getElementById('filtrar').style.display='none'; }">Filtrar</a>
  <div id="filtrar" style="display: none;">
    <form action="?url=pedidos" method="get" class="form-inline mb-3">
      <input type="hidden" name="url" value="pedidos">
      <div class="form-group mr-2">
        <label for="email">E-mail do Cliente:</label>
        <input type="email" name="email" id="email" class="form-control ml-2" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">
      </div>
      <div class="form-group mr-2">
        <label for="status">Status:</label>
        <select name="status" id="status" class="form-control ml-2">
          <option value="">Todos</option>
          <option value="Pendente" <?= isset($_GET['status']) && $_GET['status'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
          <option value="Pago" <?= isset($_GET['status']) && $_GET['status'] == 'Pago' ? 'selected' : '' ?>>Pago</option>
          <option value="Enviado" <?= isset($_GET['status']) && $_GET['status'] == 'Enviado' ? 'selected' : '' ?>>Enviado</option>
          <option value="Cancelado" <?= isset($_GET['status']) && $_GET['status'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
          <option value="Concluído" <?= isset($_GET['status']) && $_GET['status'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
        </select>
      </div>
      <div class="form-group mr-2">
        <label for="data_inicial">Data Inicial:</label>
        <input type="date" name="data_inicial" id="data_inicial" class="form-control ml-2" value="<?= isset($_GET['data_inicial']) ? htmlspecialchars($_GET['data_inicial']) : '' ?>">
      </div>
      <div class="form-group mr-2">
        <label for="data_final">Data Final:</label>
        <input type="date" name="data_final" id="data_final" class="form-control ml-2" value="<?= isset($_GET['data_final']) ? htmlspecialchars($_GET['data_final']) : '' ?>">
      </div>
      <button type="submit" class="btn btn-primary">Filtrar</button>
      <a href="?url=pedido/listar" class="btn btn-secondary ml-2">Fechar</a>
    </form>
  </div>
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
