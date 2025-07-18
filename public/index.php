<?php
session_start();

$url = $_GET['url'] ?? 'produtos';

require_once __DIR__ . '/../controllers/ProdutoController.php';
require_once __DIR__ . '/../controllers/PedidoController.php';
require_once __DIR__ . '/../controllers/CupomController.php';

switch ($url) {
    case 'produtos': listarProdutos(); break;
    case 'produtos/novo': novoProduto(); break;
    case 'produtos/salvar': salvarProduto(); break;
    case 'produtos/comprar': comprarProduto(); break;
    case 'produtos/editar': editarProduto(); break;
    case 'produtos/atualizar': atualizarProduto(); break;
    case 'carrinho': verCarrinho(); break;
    case 'carrinho/remover': removerItemCarrinho(); break;
    case 'pedido/finalizar': finalizarPedido(); break;
    case 'pedidos': listarPedidos(); break;
    case 'pedido/detalhes': detalhesPedido(); break;
    case 'pedido/editar': editarPedido(); break;
    case 'pedidos/atualizar': atualizarPedido(); break;
    case 'pedido/excluir': excluirPedido(); break;
    case 'cupons': listarCupons(); break;
    case 'cupons/novo': novoCupom(); break;
    case 'cupons/salvar': salvarCupom(); break;
    case 'cupons/editar': editarCupom(); break;
    case 'cupons/atualizar': atualizarCupom(); break;
    case 'cupons/deletar': deletarCupom(); break;
    default: listarProdutos();
}
?>