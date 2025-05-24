<?php
include 'connect/connect.php';

$import_decl = isset($_GET['import_decl']) ? trim($_GET['import_decl']) : '';

if (!empty($import_decl)) {
    $stmt = $conn->prepare("SELECT o.*, f.*, p.qt 
        FROM orders o
        INNER JOIN facture f ON o.id_facture = f.id_facture
        INNER JOIN products p ON o.id_product = p.id_product
        WHERE o.import_decl LIKE ?
        ORDER BY f.id_facture DESC");
    $stmt->execute(["%$import_decl%"]);
} else {
    $stmt = $conn->query("SELECT o.*, f.*, p.qt 
        FROM orders o
        INNER JOIN facture f ON o.id_facture = f.id_facture
        INNER JOIN products p ON o.id_product = p.id_product
        ORDER BY o.id_order DESC");
}

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>" . htmlspecialchars($row['import_decl']) . "</td>
        <td>" . htmlspecialchars($row['date_declaration']) . "</td>
        <td>" . htmlspecialchars($row['designation']) . "</td>
        <td>" . htmlspecialchars($row['s_n']) . "</td>
    </tr>";
}
?>
