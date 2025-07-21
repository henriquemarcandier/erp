<?php
require_once __DIR__ . '/../config/database.php';

class Cupom {
    public static function buscar($codigo) {
        global $conn;
        $_REQUEST['codigo'] = ($_REQUEST['codigo'] ?? '');
        $_REQUEST['validade'] = ($_REQUEST['validade'] ?? '');
        $_REQUEST['cupom'] = ($_REQUEST['cupom'] ?? '');
        $codigo = strtoupper(trim($_REQUEST['codigo']));
        $codigo = $conn->real_escape_string($codigo);
        $cupom = strtoupper(trim($_REQUEST['cupom']));
        $cupom = $conn->real_escape_string($cupom);
        $codigo = ($codigo ? $codigo : $cupom);
        $validade = strtoupper(trim($_REQUEST['validade']));
        $validade = $conn->real_escape_string($validade);
        $sql = "SELECT * FROM cupons WHERE codigo = '$codigo' AND validade >= CURDATE()";
        $res = $conn->query($sql);
        return $res->fetch_assoc();
    }
}
?>