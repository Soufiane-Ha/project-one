<?php
include 'connect/connect.php';

$import_decl = isset($_GET['import_decl']) ? trim($_GET['import_decl']) : '';

$date_declaration = '';
if (!empty($import_decl)) {
    $stmt_info = $conn->prepare("SELECT date_declaration FROM orders WHERE import_decl LIKE ? ORDER BY id_order DESC LIMIT 1");
    $stmt_info->execute(["%$import_decl%"]);
    $date_declaration = $stmt_info->fetchColumn();

    $stmt_qt = $conn->prepare("SELECT qt FROM products WHERE import_decl = ? LIMIT 1");
    $stmt_qt->execute(["%$import_decl%"]);
    $qt = $stmt_qt->fetchColumn();
}



if (!empty($import_decl)) {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE import_decl LIKE ? ORDER BY id_order DESC");
    $stmt->execute(["%$import_decl%"]);
} else {
    $stmt = $conn->query("SELECT * FROM orders ORDER BY id_order DESC");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Racape Dossier</title>
    <link rel="stylesheet" href="css/style_nav.css">
    <link rel="stylesheet" href="css/style.css">
    <style>

    </style>
</head>
<body style="margin: 30px;">

<h2>Recherche par N DECLARATION IMPORT </h2>

<form method="get" onsubmit="event.preventDefault();">
    <label for="">Declaration Import</label>
    <input type="text" id="import_decl" name="import_decl" placeholder="Entrer le n° de Déclaration Import">

    <label for="">Date declaration</label>
    <input type="text" id="date_declaration" placeholder="Date declaration" value="" readonly>

    <label for="">QTY importer</label>
    <input type="text" id="qt"  placeholder="QTY importer" value="" readonly>
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
<div class="nav_botton" style="display: flex; position: absolute; bottom: 0;">
    <ul class="nav-list">
        <li><a  href="dashboard.php">Home</a></li>
                    <li><a  href="add_imports.php">Import</a></li>
                    <li><a href="add_exports.php">Expot</a></li>
                    <li><a href="admission_temproraire.php">Admission Temproraire</a></li>
                    <li><a href="appurement.php">Appurement</a></li>
                    <li><a href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a style="background-color:red;" href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a href="lists.php">Drop-down Lists</a></li>
    </ul>
</div>

<script>
document.getElementById('import_decl').addEventListener('keyup', function () {
    let query = this.value;

    if (query.trim() === '') {
        document.getElementById('date_declaration').value = '';
        document.getElementById('qt').value = '';
        document.querySelector('tbody').innerHTML = '';
        return;
    }

    fetch('search_import_recape_dossier.php?query=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            document.getElementById('date_declaration').value = data.success ? data.date_declaration : 'No Data';
            document.getElementById('qt').value = data.success ? data.qt : 'No Data';

        });

    fetch('filter_recape_dossier.php?import_decl=' + encodeURIComponent(query))
        .then(response => response.text())
        .then(html => {
            document.querySelector('tbody').innerHTML = html;
        });
});

</script>
<script src="js/script.js"></script>

</body>
</html>
