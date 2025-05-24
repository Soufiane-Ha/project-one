<?php
include 'connect/connect.php';

$dec_reg_prec = isset($_GET['dec_reg_prec']) ? trim($_GET['dec_reg_prec']) : '';

if (!empty($dec_reg_prec)) {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE dec_reg_prec LIKE ? ORDER BY id_order DESC");
    $stmt->execute(["%$dec_reg_prec%"]);
} else {
    $stmt = $conn->query("SELECT * FROM orders ORDER BY id_order DESC");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Transfert Contrat</title>
    <link rel="stylesheet" href="css/style_nav.css">
    <link rel="stylesheet" href="css/style.css">
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
    </style>
</head>
<body>

    <h2>Recherche par DECLARATION IMPORT N°</h2>

    <form method="get">
        <input type="text" name="dec_reg_prec" placeholder="Entrer le n° de déclaration import" value="<?= htmlspecialchars($dec_reg_prec) ?>">
        <input type="submit" value="Rechercher">
    </form>

    <table>
        <thead>
            <tr>
                <th>DECLARATION IMPORT N°</th>
                <th>DESIGNATION</th>
                <th>DATE DEC</th>
                <th>S/N EXPORTER</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['dec_reg_prec']) ?></td>
                    <td><?= htmlspecialchars($row['designation']) ?></td>
                    <td><?= htmlspecialchars($row['date_declaration']) ?></td>
                    <td><?= htmlspecialchars($row['s_n']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div style="
        display: flex;
        position: absolute;
        bottom: 0;
        }">
        <ul class="nav-list">
        <li><a  href="dashboard.php">Home</a></li>
                    <li><a  href="add_imports.php">Import</a></li>
                    <li><a href="add_exports.php">Expot</a></li>
                    <li><a href="admission_temproraire.php">Admission Temproraire</a></li>
                    <li><a href="appurement.php">Appurement</a></li>
                    <li><a style="background-color:red;" href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a href="lists.php">Drop-down Lists</a></li>
</ul></div>
</body>
<script src="js/script.js"></script>
</html>