<?php
require "connect/connect.php"; 

$tracking = "92F3S212S1";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $stmt = $conn->prepare("SELECT * FROM orders o
    JOIN products p ON o.id_product = p.id_product
    WHERE o.id_order = ?");
    $stmt->execute([$id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

}

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
        .head_page {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
    padding: 10px;
    border-bottom: 2px solid #ddd;
}

.head_page img {
    width: 80px;
    height: auto;
}
    </style>
</head>
<body>
    <div class="container">
    <div class="head_page">
            <img src="image/alg.png" alt="">
            <p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p>
            <img src="image/cus.jpeg" alt="">
        </div>
        <div class="header">
            <h2><?= htmlspecialchars($order['client']) ?></h2>
        </div>
        
        <table>
            <tr>
                <td>
                    <strong>SHIP FROM</strong><br>
                    <?= htmlspecialchars($order['regime']) ?><br>
                    Dr. Saadane Street - Algiers<br>
                    City, ST ZIP<br>
                    Phone: 023 50 11 80/86<br>
                    Fax: 023 50 11 80<br>
                    Email: douane@algerian_customs.dz
                </td>
                <td>
                    <strong>TRACKING N#:</strong> <?= htmlspecialchars($tracking) ?><br>
                    <strong>PAYE:</strong> <?= htmlspecialchars($order['paye']) ?><br>
                    <strong>SALES ORDER #:</strong> <?= htmlspecialchars($order['id_order']) ?><br>
                    <strong>ORDER DATE:</strong> <?= htmlspecialchars($order['date_creation']) ?><br>
                    <strong>S/N #:</strong> <?= htmlspecialchars($order['s_n']) ?><br>
                    <strong>Product:</strong> <?= htmlspecialchars($order['designation']) ?><br>
                    <strong>Date Declaration :</strong> <?= htmlspecialchars($order['date_declaration']) ?><br>
                </td>
            </tr>
        </table>
        
        <table>
            <tr>
                <th>INFORMATION PRODUCT</th>
            </tr>
            <tr>
                <td>
                    <strong>Product : <?= htmlspecialchars($order['designation']) ?></strong><br>
                    <strong>Poid : <?= htmlspecialchars($order['poids']) ?></strong><br>
                    Quantity : <?= htmlspecialchars($order['qt']) ?><br>
                    Number Colis : <?= htmlspecialchars($order['number_colis']) ?><br>
                    Date Add : <?= htmlspecialchars($order['date_add']) ?>
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
                <td><?= htmlspecialchars($item['client']) ?></td>
                <td>/</td>
                <td><?= htmlspecialchars($item['qt']) ?></td>
                <td>/</td>
                <td>/</td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h3 class="section-title">SHIPPING INSTRUCTIONS</h3>
        <p>RESIDENTIAL DELIVERY - LIFTGATE REQUIRED</p>
        <h3 style="text-align:center;">Thank You</h3>
    </div>
    <button onclick="generatePDF()" style="
    color: red;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;">تحميل PDF</button>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function generatePDF() {
    const element = document.querySelector('.container');  
    const opt = {
        margin:       0.5,
        filename:     'packing_list.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}
</script>
</html>
