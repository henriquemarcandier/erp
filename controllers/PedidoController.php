<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Cupom.php';

function comprarProduto() {
    global $conn;
    $id = intval($_GET['id']);
    $sql = "SELECT v.id, p.nome AS produto, v.nome AS variacao, p.preco
            FROM variacoes v
            JOIN produtos p ON p.id = v.produto_id
            WHERE v.produto_id = $id LIMIT 1";
    $res = $conn->query($sql);
    $item = $res->fetch_assoc();
    if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];
    $_SESSION['carrinho'][] = [
        'id' => $item['id'],
        'produto' => $item['produto'],
        'variacao' => $item['variacao'],
        'preco' => $item['preco'],
        'quantidade' => 1
    ];
    header("Location: ?url=carrinho");
}

function verCarrinho() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cupom'])) {
        $cupom = Cupom::buscar($_POST['cupom']);
        $subtotal = 0;
        foreach ($_SESSION['carrinho'] as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }
        if ($cupom && $subtotal >= $cupom['minimo_pedido']) {
            $_SESSION['cupom_aplicado'] = $cupom['codigo'];
            $_SESSION['valor_desconto'] = $cupom['valor_desconto'];
            $_SESSION['mensagem_cupom'] = "Cupom aplicado com sucesso!";
        } else {
            unset($_SESSION['cupom_aplicado'], $_SESSION['valor_desconto']);
            $_SESSION['mensagem_cupom'] = "Cupom inválido ou não atende ao valor mínimo.";
        }
    }
    include __DIR__ . '/../views/pedidos/carrinho.php';
}

function removerItemCarrinho() {
    $indice = intval($_GET['i']);
    unset($_SESSION['carrinho'][$indice]);
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    header("Location: ?url=carrinho");
}

function finalizarPedido() {
    global $conn;
    if (isset($_SESSION['carrinho'])){

        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $email = $_POST['email'];
        $carrinho = $_SESSION['carrinho'];
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }
        $frete = ($subtotal >= 52 && $subtotal <= 166.59) ? 15 : (($subtotal > 200) ? 0 : 20);
        $desconto = $_SESSION['valor_desconto'] ?? 0;
        $codCupom = $_SESSION['cupom_aplicado'] ?? '';
        $total = $subtotal + $frete - $desconto;
        $total = ($total > 0) ? $total : 0;
        $stmt = $conn->query("INSERT INTO pedidos (subtotal, frete, desconto, total, cep, endereco, email_cliente, cupom_aplicado) VALUES ('".$subtotal."', '".$frete."', '".$desconto."', '".$total."', '".$cep."', '".$endereco."', '".$email."', '".$codCupom."')");
        $pedido_id = $conn->insert_id;
        foreach ($carrinho as $item) {
            $id = $item['id'];
            $qtd = $item['quantidade'];
            $preco = $item['preco'];
            $stmtItem = $conn->prepare("INSERT INTO pedido_itens (pedido_id, variacao_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
            $stmtItem->bind_param("iiid", $pedido_id, $id, $qtd, $preco);
            $stmtItem->execute();
            $conn->query("UPDATE estoque SET quantidade = quantidade - $qtd WHERE variacao_id = $id");
        }
        @mail($email, "Pedido Confirmado", "Seu pedido #$pedido_id foi recebido!");
        unset($_SESSION['carrinho'], $_SESSION['cupom_aplicado'], $_SESSION['valor_desconto']);
        include __DIR__ . '/../views/pedidos/finalizado.php';
    }
    else{
        ?>
        <script>
            alert('Sem produtos no carrinho no momento! Você será redirecionado para a página inicial!');
            location.href="?url=produtos";
        </script>
        <?php
    }
}
// Função para listar todos os pedidos
function listarPedidos() {
    global $conn;
    $sql = "SELECT * FROM pedidos WHERE 1=1";
    if (isset($_GET['email']) || isset($_GET['status']) || isset($_GET['data_inicial']) || isset($_GET['data_final'])) {
        $email = $_GET['email'] ?? '';
        $status = $_GET['status'] ?? '';
        $dataInicial = $_GET['data_inicial'] ?? '';
        $dataFinal = $_GET['data_final'] ?? '';
        if ($email) {
            $email = $conn->real_escape_string($email);
            $sql .= " AND email_cliente = '$email'";
        }
        if ($status) {
            $status = $conn->real_escape_string($status);
            $sql .= " AND status = '$status'";
        }
        if ($dataInicial && $dataFinal){
            if ($dataInicial) {
                $dataInicial = $conn->real_escape_string($dataInicial);
                $sql .= " AND criado_em >= '$dataInicial 00:00:00'";
            }
            if ($dataFinal) {
                $dataFinal = $conn->real_escape_string($dataFinal);
                $sql .= " AND criado_em <= '$dataFinal 23:59:59'";
            }
        }
    }
    $sql .= " ORDER BY id DESC";
    $res = $conn->query($sql);
    $pedidos = $res->fetch_all(MYSQLI_ASSOC);
    include __DIR__ . '/../views/pedidos/lista.php';
}

// Função para mostrar detalhes de um pedido
function detalhesPedido() {
    global $conn;
    $id = intval($_GET['id']);
    $resPedido = $conn->query("SELECT * FROM pedidos WHERE id = $id");
    $pedido = $resPedido->fetch_assoc();

    $resItens = $conn->query("SELECT pi.*, v.nome AS variacao_nome, p.nome AS produto_nome FROM pedido_itens pi 
        JOIN variacoes v ON pi.variacao_id = v.id
        JOIN produtos p ON v.produto_id = p.id
        WHERE pi.pedido_id = $id");
    $itens = $resItens->fetch_all(MYSQLI_ASSOC);

    include __DIR__ . '/../views/pedidos/detalhes.php';
}

function editarPedido() {
    global $conn;
    $id = intval($_GET['id']);
    $resPedido = $conn->query("SELECT * FROM pedidos WHERE id = $id");
    $pedido = $resPedido->fetch_assoc();
    if (!$pedido) {
        echo "Pedido não encontrado.";
        exit;
    }
    
    // Buscar itens do pedido
    $resItens = $conn->query("SELECT pi.*, v.nome AS variacao_nome, p.nome AS produto_nome
        FROM pedido_itens pi
        JOIN variacoes v ON pi.variacao_id = v.id
        JOIN produtos p ON v.produto_id = p.id
        WHERE pi.pedido_id = $id");
    $itens = $resItens->fetch_all(MYSQLI_ASSOC);

    include __DIR__ . '/../views/pedidos/form_editar.php';
}

function atualizarPedido() {
    global $conn;
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE pedidos SET status = ?, cep = ?, endereco = ?, email_cliente = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $status, $cep, $endereco, $email, $id);
    $stmt->execute();

    header("Location: ?url=pedidos");
}

function excluirPedido() {
    global $conn;
    $id = intval($_GET['id']);

    // Excluir itens do pedido
    $conn->query("DELETE FROM pedido_itens WHERE pedido_id = $id");

    // Excluir o pedido
    $conn->query("DELETE FROM pedidos WHERE id = $id");
    ?>
    <script>
        alert('Pedido excluído com sucesso!');
        location.href="?url=pedidos";
    </script>
    <?php
}
?>