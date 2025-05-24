<?php
session_start();
include 'connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $type = $_POST['type'];
        $regime = $_POST['regime'];
        $bureadiwan = $_POST['bureadiwan'];
        $client = $_POST['client'];
        $DecRegPrec = $_POST['dec_reg_prec'];
        $type_input = "import";

        $nb_colis = $_POST['nb_colis'];
        $poids = $_POST['poids'];
        $qt = $_POST['qt'];
        $s_n = $_POST['s_n'];       

        $n_facture = $_POST['n_facture'];

        $num_declaration = $_POST['num_declaration'];
        $designation = $_POST['designation'];
        $date_declaration = $_POST['date_declaration'];


        $paye = $_POST['paye'];
        $n_rep = $_POST['n_rep'];
        /*$echeance = $_POST['echeance'];
        $ref_contrat = $_POST['ref_contrat'];*/

        $conn->beginTransaction();

        /* $stmt = $conn->prepare("INSERT INTO comp (client, sn_compa, category_compa, pay_comp) 
         VALUES (?, ?, ?, ?)");
         $stmt->execute([$name_comp, $sn_compa, $category_comp, $pay_comp]);

         $comp_id = $conn->lastInsertId();*/

        $stmt = $conn->prepare("INSERT INTO products (number_colis, qt, poids) 
                                VALUES (?, ?, ?)");
        $stmt->execute([$nb_colis, $qt, $poids]);

        $products_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO orders (id_product, n_rep, n_facture, type, client, regime, type_input, bureadiwan, dec_reg_prec, num_declaration, s_n, designation, date_declaration, paye) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");
        $stmt->execute([$products_id, $n_rep, $n_facture, $type, $client, $regime, $type_input, $bureadiwan, $DecRegPrec, $num_declaration, $s_n, $designation, $date_declaration, $paye]);

        $conn->commit();

        echo "<script>alert('تمت إضافة الطلب بنجاح!'); window.location.href='imports.php';</script>";

    } catch (PDOException $e) {
        echo "خطأ: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_nav.css">
    <link rel="icon" href="image/cus.jpeg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* main {
            width: 100%;
            max-width: 600px;
            height: 100vh;
        }*/

        .dashboard {
            margin-top: 50px;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
        }

        h3 {
            margin-top: 15px;
            color: #555;
            border-bottom: 2px #394f66 solid;
        }

        form {
            margin-top: 45px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin: 5px 0;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
            width: 100%;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .dashboard {
                padding: 15px;
            }

            input[type="text"],
            input[type="submit"] {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
    <title>Dashboard</title>
</head>

<body>
    <main>
        <div class="head_page"><img src="image/alg.png" alt="">
            <p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p><img src="image/cus.jpeg"
                alt="">
        </div>
        <article class="dashboard">

            <h1>Add Import</h1>
            <form action="" method="post">
                <div>

                    <label>Select Type | حدد النوع</label>
                    <select name="type" id="type">
                        <option value="">--select type--</option>
                        <option value="sigad">Sigad</option>
                        <option value="alces">Alces</option>
                    </select>
                    <div id="extra-fields" style="display: none; margin-top: 10px;">
                        <label>N Rep | رقم الدليل</label>
                        <?php
                        $stmt_n_rep = $conn->prepare("SELECT MAX(n_rep) AS max_rep FROM orders WHERE type = 'sigad' AND type_input = 'import'");
                        $stmt_n_rep->execute();
                        $result = $stmt_n_rep->fetch(PDO::FETCH_ASSOC);

                        $next_n_rep = isset($result['max_rep']) ? ((int)$result['max_rep'] + 1) : 1;

                        echo '<input type="number" name="n_rep" value="' . htmlspecialchars($next_n_rep) . '" readonly>';
                        ?>

                        <label for="bureadiwan">Bureau Dudiwan | مكتب الديوان</label>
                           <select name="bureadiwan" id="">
                        <option value="">--select bureau dudiwan--</option>
                        <?php
                            $stmt_bureadiwans = $conn->prepare("SELECT type,item FROM items_list WHERE type = 'bureadiwan' ");
                            $stmt_bureadiwans->execute();
                            $bureadiwans = $stmt_bureadiwans->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($bureadiwans as $bureadiwan) {
                                echo '<option value="' . htmlspecialchars($bureadiwan['item']) . '">' . htmlspecialchars($bureadiwan['item']) . '</option>';
                            }                       
                             ?>
                    </select>

                    </div>

                    <label>Client | الزبون</label>
                    <select name="client" id="">
                        <option value="">--select alces--</option>
                        <?php
                            $stmt_client = $conn->prepare("SELECT type,item FROM items_list WHERE type =  'client'");
                            $stmt_client->execute();
                            $clients = $stmt_client->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($clients as $client) {
                                echo '<option value="' . htmlspecialchars($client['item']) . '">' . htmlspecialchars($client['item']) . '</option>';
                            }?>
                    </select>

                    <label>Regime النظام</label>
                    <select name="regime" id="" required>
                        <option value="">--select regime--</option>
                        <?php
                            $stmt_regimes = $conn->prepare("SELECT type,item FROM items_list WHERE type = 'regime' ");
                            $stmt_regimes->execute();
                            $regimes = $stmt_regimes->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($regimes as $regime) {
                                echo '<option value="' . htmlspecialchars($regime['item']) . '">' . htmlspecialchars($regime['item']) . '</option>';
                            }                       
                             ?>
                    </select>

                    <label>Nb-Colis | رقم السلع</label>
                    <input type="text" name="nb_colis" required>
                    <label>QTY | الكمية</label>
                    <input type="number" name="qt" required>
                    <label>Poids | الوزن</label>
                    <input type="number" name="poids" step="0.001" required>

                    <label>Regime President | النظام الرئيسي</label>
                    <select name="regim_president" id="" required>
                        <option value="">--select regime president--</option>
                        <?php
                            $stmt_regim_president = $conn->prepare("SELECT type,item FROM items_list WHERE type =  'regime_president'");
                            $stmt_regim_president->execute();
                            $regim_presidents = $stmt_regim_president->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($regim_presidents as $regim_president) {
                                echo '<option value="' . htmlspecialchars($regim_president['item']) . '">' . htmlspecialchars($regim_president['item']) . '</option>';
                            }  ?>
                    </select>

                    <label>Dec Reg Prec</label>
                    <input type="text" name="dec_reg_prec" required>

                    <label>Date Reg</label>
                    <input type="date" name="date_re" required>

                    <label>Bureau Douane Reg Prec | مكتب الديوان المنطقة</label>
                    <input type="text" name="bureau_douane" required>

                    <label>Declaration Number | رقم تصريح </label>
                    <input type="number" name="num_declaration" required>
                    
                    <label>Date Dec | تاريخ التصريح</label>
                    <input type="date" name="date_declaration" required>

                    <label>Designation | تسمية</label>
                    <input type="text" name="designation" required>

                    <label>S/N | رقم التعريف</label>
                    <input type="text" name="s_n" required>

                    <label>N-Facture | رقم الفاتورة</label>
                    <input type="text" name="n_facture" required>

                    <label>Paye | الدفع </label>
                    <select name="paye" id="" required>
                        <option value="">--select paye--</option>
                        <option value="oui">OUI</option>
                        <option value="non">NON</option>
                    </select>
                </div>
                <input type="submit" value="Send">

            </form>
        </article>
        <div class="nav_botton" 
        style="
        display: flex;
        position: fixed;
        bottom: 0;
        }">
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
            </ul>
        </div>
    </main>
</body>
<script>
    document.getElementById('type').addEventListener('change', function () {
        const extraFields = document.getElementById('extra-fields');
        if (this.value === 'sigad') {
            extraFields.style.display = 'block';
        } else {
            extraFields.style.display = 'none';
        }
    });
</script>
<script src="js/script.js"></script>
</html>