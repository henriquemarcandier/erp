$(function () {
    listarProdutos();
  
    $('#formProduto').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        url: '../ajax/produtos_ajax.php',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (res) {
          alert(res.mensagem);
          if (res.sucesso) {
            $('#formProduto')[0].reset();
            listarProdutos();
            bootstrap.Modal.getInstance(document.getElementById('modalProduto')).hide();
          }
        }
      });
    });
  });
  
  function listarProdutos() {
    $.get('../ajax/produtos_ajax.php', { acao: 'listar' }, function (html) {
      $('#tabela-produtos').html(html);
    });
  }
  
  function abrirModalProduto() {
    $('#formProduto')[0].reset();
    $('#produto_id').val('');
    $('#atributos-container').html('');
    adicionarAtributo();
    $('#modalProdutoLabel').text('Cadastrar Produto');
    new bootstrap.Modal(document.getElementById('modalProduto')).show();
  }
  
  function editarProduto(id) {
    $.get('../ajax/produtos_ajax.php', { acao: 'buscar', id }, function (res) {
      $('#id').val(res.id);
      $('#nome').val(res.nome);
      $('#preco').val(res.preco);
      $('#nomeVariacao').val(res.nomeVariacao);
      $('#estoque').val(res.estoque);
      $.get('../ajax/produtos_ajax.php', { acao: 'buscar_atributos', id }, function (attrs) {
        attrs.forEach(attr => {
          $('#atributos-container').append(`
            <div class="input-group mb-2">
              <input type="text" class="form-control" name="atributo_nome[]" value="${attr.nome}" />
              <input type="text" class="form-control" name="atributo_valor[]" value="${attr.valor}" />
              <button type="button" class="btn btn-danger" onclick="removerAtributo(this)">X</button>
            </div>
          `);
        });
      }, 'json');
      $('#modalProdutoLabel').text('Editar Produto');
      new bootstrap.Modal(document.getElementById('modalProduto')).show();
    }, 'json');
  }
  
  function excluirProduto(id) {
    if (confirm('Deseja excluir este produto?')) {
      $.post('../ajax/produtos_ajax.php', { acao: 'excluir', id }, function (res) {
        alert(res.mensagem);
        listarProdutos();
      }, 'json');
    }
  }

  function abrirModal(id = null) {
    if (id) {
      // edição
      $.get('index.php?rota=produto/buscar&id=' + id, function (produto) {
        $('#produtoId').val(produto.id);
        $('#nome').val(produto.nome);
        $('#preco').val(produto.preco);
        $('#descricao').val(produto.descricao);
        $('#tituloModal').text('Editar Produto');
        new bootstrap.Modal('#modalProduto').show();
      }, 'json');
    } else {
      // novo
      $('#formProduto')[0].reset();
      $('#produtoId').val('');
      $('#tituloModal').text('Novo Produto');
      new bootstrap.Modal('#modalProduto').show();
    }
  }
  
  function comprarProduto(id) {
        $.post('../ajax/carrinho_ajax.php', { acao: 'adicionar', id }, function (res) {
          if (res.sucesso) {
            window.location.href = 'index.php?pagina=carrinho';
          } else {
            alert(res.mensagem || 'Erro ao adicionar ao carrinho.');
          }
        }, 'json');
  }
  
  function adicionarAtributo() {
    $('#atributos-container').append(`
      <div class="input-group mb-2">
        <input type="text" class="form-control" name="atributo_nome[]" placeholder="Nome" />
        <input type="text" class="form-control" name="atributo_valor[]" placeholder="Valor" />
        <button type="button" class="btn btn-danger" onclick="removerAtributo(this)">X</button>
      </div>
    `);
  }
  
  function removerAtributo(btn) {
    $(btn).closest('.input-group').remove();
  }
  