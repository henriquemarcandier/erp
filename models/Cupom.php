<?php
require_once __DIR__ . '/../config/database.php';

class Cupom {
    public static function buscar($codigo) {
        global $conn;
        $codigo = strtoupper(trim($_REQUEST['codigo']));
        $codigo = $conn->real_escape_string($codigo);
        $validade = strtoupper(trim($_REQUEST['validade']));
        $validade = $conn->real_escape_string($validade);
        echo $codigo."--".$validade."--";
        $res = $conn->query("SELECT * FROM cupons WHERE codigo = '$codigo' AND validade >= CURDATE()");
        return $res->fetch_assoc();
    }
}
?>