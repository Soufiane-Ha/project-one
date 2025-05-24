<?php 
include 'connect/connect.php';

$stmt = $conn->prepare(
    "SELECT * 
    FROM orders o
    JOIN products p ON p.id_product = o.id_product
    WHERE type_input = 'import'"
);
$stmt->execute(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_nav.css">

    <title>Imports</title>
</head>

<body>
    <main>
        <div class="head_page">
            <img src="image/alg.png" alt="">
            <p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p>
            <img src="image/cus.jpeg" alt="">
        </div>
        <article class="import-article">
            <h1>Table For Imports</h1>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Poids</th>
                        <th>Date</th>
                        <th>QT</th>
                        <th>S/N</th>
                        <th>Designation</th>
                        <th>Regime</th>
                        <th>Date/Dec</th>
                    </tr>
                </thead>
                <tbody>
                <?php   $i = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
                $id = $row['id_order'];
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($row['client']) ?></td>
                        <td><?= htmlspecialchars($row['poids']) ?></td>
                        <td><?= htmlspecialchars($row['date_creation']) ?></td>
                        <td><?= htmlspecialchars($row['qt']) ?></td>
                        <td><?= htmlspecialchars($row['s_n']) ?></td>
                        <td><?= htmlspecialchars($row['designation']) ?></td>
                        <td><?= htmlspecialchars($row['regime']) ?></td>
                        <td><?= htmlspecialchars($row['date_declaration']) ?></td>
                        <td><input type="button" name="" id="delete" value="Delete" onclick="alert('هل أنت متأكد من حذف هاذا السجل')"></td>
                        <td><input type="button" name="" id="more" value="More" onclick="window.location.href='details.php?id=<?=$id?>'"></td>
                        <td><input type="button" name="" id="edit" value="Edit" onclick="window.location.href='edit.php?id=<?=$id?>'"></td>
                    </tr>
                    <?php $i++; endwhile;?>
                    </tbody>
            </table>
        </article>
        <div class="nav_botton" 
        style="
        display: flex;
        position: absolute;
        bottom: 0;
        ">
        <ul class="nav-list">

                    <li><a  href="dashboard.php">Home</a></li>
                    <li><a style="background-color:red;" href="add_imports.php">Import</a></li>
                    <li><a href="add_exports.php">Expot</a></li>
                    <li><a href="admission_temproraire.php">Admission Temproraire</a></li>
                    <li><a href="appurement.php">Appurement</a></li>
                    <li><a href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a href="lists.php">Drop-down Lists</a></li>
</ul></div>
    </main>
</body>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".more-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            window.location.href = "show_more_infor_imports.php?id=" + id;
        });
    });

    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this entry?")) {
                window.location.href = "delete_import.php?id=" + id;
            }
        });
    });

    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            window.location.href = "edit_import.php?id=" + id;
        });
    });
});
</script>

</html>
