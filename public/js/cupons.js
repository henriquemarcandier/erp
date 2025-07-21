// Arquivo: public/js/cupons.js

$(function () {
    listarCupons();
  
    $('#formCupom').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        url: '../ajax/cupons_ajax.php',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (res) {
          alert(res.mensagem);
          if (res.sucesso) {
            $('#formCupom')[0].reset();
            listarCupons();
            bootstrap.Modal.getInstance(document.getElementById('modalCupom')).hide();
          }
        }
      });
    });
  });
  
  function listarCupons() {
    $.get('../ajax/cupons_ajax.php', { acao: 'listar' }, function (html) {
      $('#tabela-cupons').html(html);
    });
  }
  
  function abrirModalCupom() {
    $('#formCupom')[0].reset();
    $('#cupom_id').val('');
    $('#modalCupomLabel').text('Cadastrar Cupom');
    new bootstrap.Modal(document.getElementById('modalCupom')).show();
  }
  
  function editarCupom(id) {
    $.get('../ajax/cupons_ajax.php', { acao: 'buscar', id }, function (res) {
      $('#cupom_id').val(res.id);
      $('#codigo').val(res.codigo);
      $('#valor_desconto').val(parseFloat(res.valor_desconto).toFixed(2));
      $('#minimo_pedido').val(parseFloat(res.minimo_pedido).toFixed(2));
      $('#validade').val(res.validade);
      $('#modalCupomLabel').text('Editar Cupom');
      new bootstrap.Modal(document.getElementById('modalCupom')).show();
    }, 'json');
  }
  
  function excluirCupom(id) {
    if (confirm('Deseja excluir este cupom?')) {
      $.post('../ajax/cupons_ajax.php', { acao: 'excluir', id }, function (res) {
        alert(res.mensagem);
        listarCupons();
      }, 'json');
    }
  }
  