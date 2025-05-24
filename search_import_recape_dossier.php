<?php
include 'connect/connect.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (empty($query)) {
    echo json_encode(['success' => false]);
    exit;
}

$stmt = $conn->prepare(
    "SELECT o.date_declaration, p.qt 
     FROM products p
     INNER JOIN orders o ON o.id_product = p.id_product
     WHERE o.import_decl LIKE ?
     ORDER BY o.id_order DESC
     LIMIT 1"
);
$stmt->execute(["%$query%"]);

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo json_encode([
        'success' => true,
        'date_declaration' => $row['date_declaration'],
        'qt' => $row['qt']
    ]);
} else {
echo json_encode([
    'success' => false,
    'date_declaration' => 'No Data',
    'qt' => 'No Data'
]);
}
?>
