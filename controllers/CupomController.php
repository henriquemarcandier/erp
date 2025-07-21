<?php
require_once __DIR__ . '/../config/database.php';

function listarCupons() {
    global $conn;
    $codigo = $_GET['codigo'] ?? '';;
    $validade = $_GET['validade'] ?? '';;
    $sql = "SELECT * FROM cupons ";
    if ($codigo || $validade) {
        $sql .= "WHERE 1=1 ";
        if ($codigo) {
            $codigo = $conn->real_escape_string($codigo);
            $sql .= "AND codigo LIKE '%$codigo%' ";
        }
        if ($validade) {
            $validade = $conn->real_escape_string($validade);
            $sql .= "AND validade = '$validade' ";
        }
    }
    $sql .= "ORDER BY validade DESC";
    $res = $conn->query($sql);
    $cupons = $res->fetch_all(MYSQLI_ASSOC);
    include __DIR__ . '/../views/cupons/lista.php';
}

function novoCupom() {
    include __DIR__ . '/../views/cupons/form.php';
}

function salvarCupom() {
    global $conn;
    $codigo = strtoupper(trim($_POST['codigo']));
    $valor = floatval($_POST['valor_desconto']);
    $minimo = floatval($_POST['minimo_pedido']);
    $validade = $_POST['validade'];

    $stmt = $conn->prepare("INSERT INTO cupons (codigo, valor_desconto, minimo_pedido, validade) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdds", $codigo, $valor, $minimo, $validade);
    $stmt->execute();

    header("Location: ?url=cupons");
}

function deletarCupom() {
    global $conn;
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM cupons WHERE id = $id");
    ?>
    <script>
        alert('Cupom excluído com sucesso!');
        location.href="?url=cupons";
    </script>
    <?php
}

function editarCupom() {
    global $conn;
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT * FROM cupons WHERE id = $id");
    $cupom = $res->fetch_assoc();
    if (!$cupom) {
        echo "Cupom não encontrado.";
        exit;
    }
    include __DIR__ . '/../views/cupons/form_editar.php';
}

function atualizarCupom() {
    global $conn;
    $id = intval($_POST['id']);
    $codigo = strtoupper(trim($_POST['codigo']));
    $valor = floatval($_POST['valor_desconto']);
    $minimo = floatval($_POST['minimo_pedido']);
    $validade = $_POST['validade'];

    $stmt = $conn->prepare("UPDATE cupons SET codigo = ?, valor_desconto = ?, minimo_pedido = ?, validade = ? WHERE id = ?");
    $stmt->bind_param("sddsi", $codigo, $valor, $minimo, $validade, $id);
    $stmt->execute();

    header("Location: ?url=cupons");
}

?>