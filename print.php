<?php
include 'connect/connect.php';

$order_id = $_GET['order_id'] ?? 1; 

/*$stmt = $conn->prepare("
    SELECT o.*, c.name AS customer_name, c.company_name, c.address, c.city, c.phone
    FROM orders o
    JOIN customers c ON o.customer_id = c.id
    WHERE o.id_order = ?
");
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);
*/
$stmt_items = $conn->prepare("
    SELECT *
    FROM orders o
    JOIN products p ON o.id_product = p.id_product
    WHERE o.id_order = ?
");
$stmt_items->execute([$order_id]);
$items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { display: flex; justify-content: space-between; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .section-title { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><?= htmlspecialchars($order['name_compa']) ?></h2>
            <h2>Packing List</h2>
        </div>
        
        <table>
            <tr>
                <td>
                    <strong>SHIP FROM</strong><br>
                    Company Name<br>
                    Street Address<br>
                    City, ST ZIP<br>
                    Phone: 000-000-0000<br>
                    Fax: 000-000-0000<br>
                    Email: name@company.com
                </td>
                <td>
                    <strong>SHIP DATE:</strong> <?= htmlspecialchars($order['ship_date']) ?><br>
                    <strong>SALES ORDER #:</strong> <?= htmlspecialchars($order['id_order']) ?><br>
                    <strong>ORDER DATE:</strong> <?= htmlspecialchars($order['order_date']) ?><br>
                    <strong>PO #:</strong> <?= htmlspecialchars($order['po_number']) ?><br>
                    <strong>CARRIER:</strong> <?= htmlspecialchars($order['carrier']) ?><br>
                    <strong>TRACKING #:</strong> <?= htmlspecialchars($order['tracking_number']) ?>
                </td>
            </tr>
        </table>
        
        <table>
            <tr>
                <th>SHIP TO DESTINATION</th>
                <th>BILL TO</th>
            </tr>
            <tr>
                <td>
                    <strong><?= htmlspecialchars($order['customer_name']) ?></strong><br>
                    <strong><?= htmlspecialchars($order['company_name']) ?></strong><br>
                    <?= htmlspecialchars($order['address']) ?><br>
                    <?= htmlspecialchars($order['city']) ?><br>
                    <?= htmlspecialchars($order['phone']) ?>
                </td>
                <td>
                    <strong><?= htmlspecialchars($order['customer_name']) ?></strong><br>
                    <strong><?= htmlspecialchars($order['company_name']) ?></strong><br>
                    <?= htmlspecialchars($order['address']) ?><br>
                    <?= htmlspecialchars($order['city']) ?><br>
                    <?= htmlspecialchars($order['phone']) ?>
                </td>
            </tr>
        </table>
        
        <h3 class="section-title">PACKING LIST SUMMARY</h3>
        <table>
            <tr>
                <th>PACKAGE #</th>
                <th>DESCRIPTION</th>
                <th>SKU</th>
                <th>QTY</th>
                <th>WEIGHT (LB)</th>
                <th>LxWxH (IN)</th>
            </tr>
            <?php foreach ($items as $index => $item): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= htmlspecialchars($item['sku']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td><?= htmlspecialchars($item['weight']) ?></td>
                <td><?= htmlspecialchars($item['dimensions']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <h3 class="section-title">SHIPPING INSTRUCTIONS</h3>
        <p>RESIDENTIAL DELIVERY - LIFTGATE REQUIRED</p>
        <h3 style="text-align:center;">Thank You</h3>
    </div>
</body>
</html>
