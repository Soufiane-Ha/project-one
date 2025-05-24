<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_nav.css">
    <link rel="icon" href="image/cus.jpeg">
    <title>Dashboard</title>
</head>

<body>
    <main>
        <div class="head_page"><img src="image/alg.png" alt=""><p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p><img src="image/cus.jpeg" alt=""></div>
            <article class="dashboard" style="display:block;">
                <div style="    font-size: xx-large;
    padding: 47px;">
                    <h3>WELLCOM USER</h3>
                </div>
                <div>
                     <?php include('boxs_number.php');?>
                </div>
            </article>
            <div class="nav_botton" 
            style="
            display: flex;
            position: fixed;
            bottom: 0;
            }">
                <ul class="nav-list">
                    <li><a style="background-color:red;" href="dashboard.php">Home</a></li>
                    <li><a href="add_imports.php">Import</a></li>
                    <li><a  href="add_exports.php">Expot</a></li>
                    <li><a href="admission_temproraire.php">Admission Temproraire</a></li>
                    <li><a href="appurement.php">Appurement</a></li>
                    <li><a href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a href="lists.php">Drop-down Lists</a></li>
                </ul>
        </div>
    </main>
</body>
<script src="js/script.js"></script>

</html>