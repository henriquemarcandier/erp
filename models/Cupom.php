<?php
require_once __DIR__ . '/../config/database.php';

class Cupom {
    public static function buscar($codigo) {
        global $conn;
        $codigo = strtoupper(trim($codigo));
        $res = $conn->query("SELECT * FROM cupons WHERE codigo = '$codigo' AND validade >= CURDATE()");
        return $res->fetch_assoc();
    }
}
?>