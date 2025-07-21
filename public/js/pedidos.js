// Arquivo: public/js/pedidos.js

$(document).ready(function () {
    listarPedidos();
});

function listarPedidos() {
    $.get('../ajax/pedidos_ajax.php', { acao: 'listar' }, function (html) {
        $('#tabela-pedidos').html(html);
    });
}

function verPedido(id) {
    $.get('../ajax/pedidos_ajax.php', { acao: 'detalhes', id }, function (html) {
        $('#detalhes-pedido').html(html);
        new bootstrap.Modal(document.getElementById('modalPedido')).show();
    });
}
  