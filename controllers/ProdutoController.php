<?php
require_once __DIR__ . '/../models/Produto.php';

function listarProdutos() {
    $produtos = Produto::listar();
    include __DIR__ . '/../views/produtos/lista.php';
}

function novoProduto() {
    include __DIR__ . '/../views/produtos/form.php';
}

function salvarProduto() {
    $nome = $_POST['nome'];
    $preco = floatval($_POST['preco']);
    $variacoes = $_POST['variacoes'];
    Produto::criar($nome, $preco, $variacoes);
    header("Location: ?url=produtos");
}

function editarProduto() {
    global $conn;
    $id = intval($_GET['id']);
    
    // Buscar produto
    $resProduto = $conn->query("SELECT * FROM produtos WHERE id = $id");
    $produto = $resProduto->fetch_assoc();
    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }
    
    // Buscar variações e estoque
    $resVariacoes = $conn->query("SELECT v.*, e.quantidade FROM variacoes v
        LEFT JOIN estoque e ON v.id = e.variacao_id
        WHERE v.produto_id = $id");
    $variacoes = $resVariacoes->fetch_all(MYSQLI_ASSOC);

    include __DIR__ . '/../views/produtos/form_editar.php';
}

function atualizarProduto() {
    global $conn;
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $preco = floatval($_POST['preco']);
    $variacoes = $_POST['variacoes'] ?? [];

    // Atualizar produto
    $stmt = $conn->prepare("UPDATE produtos SET nome = ?, preco = ? WHERE id = ?");
    $stmt->bind_param("sdi", $nome, $preco, $id);
    $stmt->execute();

    // Atualizar variações e estoque
    foreach ($variacoes as $v) {
        $vid = intval($v['id']);
        $vnome = $v['nome'];
        $vestoque = intval($v['estoque']);

        // Atualizar variação
        $stmtVar = $conn->prepare("UPDATE variacoes SET nome = ? WHERE id = ?");
        $stmtVar->bind_param("si", $vnome, $vid);
        $stmtVar->execute();

        // Atualizar estoque
        $stmtEst = $conn->prepare("UPDATE estoque SET quantidade = ? WHERE variacao_id = ?");
        $stmtEst->bind_param("ii", $vestoque, $vid);
        $stmtEst->execute();
    }

    header("Location: ?url=produtos");
}

function excluirProduto() {
    global $conn;
    $id = intval($_GET['id']);

    // Excluir estoque das variações do produto
    $conn->query("DELETE e FROM estoque e 
        JOIN variacoes v ON e.variacao_id = v.id
        WHERE v.produto_id = $id");

    // Excluir variações do produto
    $conn->query("DELETE FROM variacoes WHERE produto_id = $id");

    // Excluir o produto
    $conn->query("DELETE FROM produtos WHERE id = $id");

    header("Location: ?url=produtos");
}
?>