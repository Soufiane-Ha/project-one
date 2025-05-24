<?php 
include 'connect/connect.php';

$stmt = $conn->prepare(
    "SELECT * 
    FROM orders o
    JOIN products p ON p.id_product = o.id_product
    WHERE type = 'imports'"
);
$stmt->execute(); 

$dec = $_GET['dec_reg_prec'] ?? '';
$product = [];
if ($dec !== '') {
    $stmt = $conn->prepare(
        "SELECT o.*, f.*, p.*
         FROM orders o 
         JOIN products p ON p.id_product = o.id_product
         JOIN facture f ON 1 = 1
         WHERE o.dec_reg_prec = ?"
    );
    $stmt->execute([$dec]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_nav.css">
    <style>
         form {
            background-color: #fff;
            padding: 20px;
            max-width: 700px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

    <title>Imports</title>
</head>

<body>
    <main>
        <div class="head_page">
            <img src="image/alg.png" alt="">
            <p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p>
            <img src="image/cus.jpeg" alt="">
        </div>
        <article class="admission-article">
<h2>Recherche par DECLARATION IMPORT N°</h2>
<form method="get">
    <label>Declaration Import</label>
    <input type="text" name="dec_reg_prec" value="<?= htmlspecialchars($dec) ?>" required>
        <button type="submit">Rechercher</button>

    <label>Date declaration</label>
    <input type="text" value="<?= $product['date_declaration'] ?? 'NO DATA' ?>" readonly>

    <label>QTY Importer</label>
    <?php
    $qt = isset($product['qt']) ? (int)$product['qt'] : 0;
    $bg = $qt === 0 ? '#ff1313' : '';
    ?>
    <input type="text" style="background:<?= $bg ?>;" value="<?= $qt ?>" readonly>

    <label>Client</label>
    <input type="text" value="<?= $product['client'] ?? 'NO DATA' ?>" readonly>

    <label>Number Colis</label>
    <input type="text" value="<?= $product['number_colis'] ?? 'NO DATA' ?>" readonly>

    <label>Poind</label>
    <input type="text" value="<?= $product['poids'] ?? 'NO DATA' ?>" readonly>

    <label>S/N</label>
    <input type="text" value="<?= $product['s_n'] ?? 'NO DATA' ?>" readonly>

    <!--<label>Date Expiration</label>
    <input type="text" value="<?= $product['date_exp'] ?? 'NO DATA' ?>" readonly>

    <label>Date d'Arrivée</label>
    <input type="text" value="<?= $product['date_avr'] ?? 'NO DATA' ?>" readonly>-->

    <label>Number Rep</label>
    <input type="text" value="<?= $product['n_rep'] ?? 'NO DATA' ?>" readonly>

    <label>Facture Number</label>
    <input type="text" value="<?= $product['n_facture'] ?? 'NO DATA' ?>" readonly>

    <label>Paye</label>
    <input type="text" value="<?= $product['paye'] ?? 'NO DATA' ?>" readonly>
</form>
        </article>
        <div class="nav_botton" 
        style="
        display: flex;
        position: fixed;
        bottom: 0;
        ">
        <ul class="nav-list">
        <li><a  href="dashboard.php">Home</a></li>
                    <li><a  href="add_imports.php">Import</a></li>
                    <li><a href="add_exports.php">Expot</a></li>
                    <li><a style="background-color:red;" href="admission_temproraire.php">Admission Temproraire</a></li>
                    <li><a href="appurement.php">Appurement</a></li>
                    <li><a href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a href="lists.php">Drop-down Lists</a></li>

</ul></div>
    </main>
</body>
<script src="js/script.js"></script>

</html>
