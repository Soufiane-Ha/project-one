<?php
include 'connect/connect.php';

$dec_reg_prec = isset($_GET['dec_reg_prec']) ? trim($_GET['dec_reg_prec']) : '';

if (!empty($dec_reg_prec)) {
    $stmt = $conn->prepare("SELECT f.*, o.*, p.qt, o.designation
     FROM facture f
     INNER JOIN orders o ON o.id_facture = f.id_facture
     INNER JOIN products p ON p.id_product = o.id_product
     WHERE o.dec_reg_prec LIKE ? AND type_input = 'export'
     ORDER BY o.id_facture DESC");
    $stmt->execute(["%$dec_reg_prec%"]);
} else {
    $stmt = $conn->query(
        "SELECT f.*, o.*, p.qt, o.designation
        FROM orders o
        INNER JOIN facture f ON o.id_facture = f.id_facture
        INNER JOIN products p ON p.id_product = o.id_product
        ORDER BY o.id_order DESC
        ");
}


$select_product = $conn->query(
    "SELECT * 
    FROM products p
    INNER JOIN orders o ON p.id_product = o.id_product
    ORDER BY o.id_facture DESC"
);
$product = $select_product->fetch();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>" . htmlspecialchars($row['dec_reg_prec']) . "</td>
        <td>" . htmlspecialchars($row['date_declaration']) . "</td>
        <td>" . htmlspecialchars($row['designation']) . "</td>
        <td>" . htmlspecialchars($row['s_n']) . "</td>
    </tr>";
}

?>
