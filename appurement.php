<?php
include 'connect/connect.php';

$dec_reg_prec = isset($_GET['dec_reg_prec']) ? trim($_GET['dec_reg_prec']) : '';

$date_declaration = '';
if (!empty($dec_reg_prec)) {
    $stmt_info = $conn->prepare(
        "SELECT * 
        FROM facture f
        INNER JOIN `orders` o ON o.id_facture = f.id_facture
        WHERE o.dec_reg_prec 
        LIKE ? 
        ORDER BY id_order 
        DESC");
    $stmt_info->execute(["%$dec_reg_prec%"]);
    $date_declaration = $stmt_info->fetchColumn();
}

if (!empty($dec_reg_prec)) {
    $stmt = $conn->prepare(
    "SELECT * 
     FROM facture f
     INNER JOIN `orders` o ON o.id_facture = f.id_facture
     WHERE o.dec_reg_prec LIKE ?
     ORDER BY f.id_facture DESC"
    );

    $stmt->execute(["%$dec_reg_prec%"]);
} else {
    $stmt = $conn->query(
        "SELECT * 
        FROM facture f
        INNER JOIN `orders` o ON o.id_facture = f.id_facture
        ORDER BY o.id_facture 
        DESC");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche Appurement</title>
    <link rel="stylesheet" href="css/style_nav.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            width: 250px;
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 8px 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #aaa;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

<h2>Recherche par DECLARATION IMPORT N°</h2>

<form method="get" onsubmit="event.preventDefault();">
    <label for="">Declaration Import</label>
    <input type="text" id="dec_reg_prec" name="dec_reg_prec" placeholder="Entrer le n° de déclaration import">

    <label for="">Date declaration</label>
    <input type="text" id="date_declaration" placeholder="Date declaration" value="" readonly>

    <label for="">QTY importer</label>
<?php
$select_product = $conn->query(
    "SELECT p.*, o.* 
     FROM products p
     INNER JOIN orders o ON p.id_product = o.id_product
     ORDER BY o.id_facture DESC"
);
$product = $select_product->fetch();

$qt = isset($product['qt']) ? (int)$product['qt'] : 0;
$backgroundColor = ($qt === 0) ? '#ff1313' : '#13ff7c';
?>
<input type="text" id="qt"
   style="background: <?= $backgroundColor ?>;"
   placeholder="QTY importer"
   value=""
   readonly>


</form>

<table>
    <thead>
        <tr>
            <th>N° CONTRAT</th>
            <th>DATE DEC</th>
            <th>Designation</th>
            <th>S/N</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<div class="nav_botton" style="display: flex; position: fixed; bottom: 0;">
    <ul class="nav-list">
        <li><a  href="dashboard.php">Home</a></li>
                    <li><a  href="add_imports.php">Import</a></li>
                    <li><a href="add_exports.php">Expot</a></li>
                    <li><a href="admission_temproraire.php">Admission Temproraire</a></li>
                    <li><a style="background-color:red;" href="appurement.php">Appurement</a></li>
                    <li><a href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a href="lists.php">Drop-down Lists</a></li>
    </ul>
</div>

<script>
document.getElementById('dec_reg_prec').addEventListener('keyup', function () {
    let query = this.value;

    fetch('search_appurement.php?query=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            document.getElementById('date_declaration').value = data.success ? data.date_declaration : '';
            document.getElementById('qt').value = data.success ? data.qt : '';
        });

    fetch('filter_appurement.php?dec_reg_prec=' + encodeURIComponent(query))
        .then(response => response.text())
        .then(html => {
            document.querySelector('tbody').innerHTML = html;
        });
});

</script>
<script src="js/script.js"></script>

</body>
</html>
