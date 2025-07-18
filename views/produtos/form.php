<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-4">
  <h3>Novo Produto</h3>
  <form method="POST" action="?url=produtos/salvar">
    <div class="mb-3">
      <label>Nome do Produto</label>
      <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Preço</label>
      <input type="number" step="0.01" name="preco" class="form-control" required>
    </div>
    <h5>Variações</h5>
    <div id="variacoes">
      <div class="row mb-2">
        <div class="col">
          <input type="text" name="variacoes[0][nome]" placeholder="Nome da variação" class="form-control" required>
        </div>
        <div class="col">
          <input type="number" name="variacoes[0][estoque]" placeholder="Estoque" class="form-control" required>
        </div>
      </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary mb-3" onclick="addVariacao()">+ Adicionar Variação</button><br>
    <button type="submit" class="btn btn-primary">Salvar Produto</button>
  </form>
</div>

<script>
let index = 1;
function addVariacao() {
  const container = document.getElementById('variacoes');
  const row = document.createElement('div');
  row.className = 'row mb-2';
  row.innerHTML = `
    <div class="col">
      <input type="text" name="variacoes[${index}][nome]" placeholder="Nome da variação" class="form-control" required>
    </div>
    <div class="col">
      <input type="number" name="variacoes[${index}][estoque]" placeholder="Estoque" class="form-control" required>
    </div>
  `;
  container.appendChild(row);
  index++;
}
</script>
<?php include __DIR__ . '/../layout/footer.php'; ?>
