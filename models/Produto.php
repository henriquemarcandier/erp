<?php
require_once __DIR__ . '/../config/database.php';

class Produto {
    public static function listar() {
        global $conn;
        $res = $conn->query("SELECT * FROM produtos");
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public static function criar($nome, $preco, $variacoes) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
        $stmt->bind_param("sd", $nome, $preco);
        $stmt->execute();
        $produto_id = $conn->insert_id;
        foreach ($variacoes as $var) {
            $nomeVar = $var['nome'];
            $qtd = intval($var['estoque']);
            $stmtVar = $conn->prepare("INSERT INTO variacoes (produto_id, nome) VALUES (?, ?)");
            $stmtVar->bind_param("is", $produto_id, $nomeVar);
            $stmtVar->execute();
            $variacao_id = $conn->insert_id;
            $stmtEstoque = $conn->prepare("INSERT INTO estoque (variacao_id, quantidade) VALUES (?, ?)");
            $stmtEstoque->bind_param("ii", $variacao_id, $qtd);
            $stmtEstoque->execute();
        }
    }
}
?>