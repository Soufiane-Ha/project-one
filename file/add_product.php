<?php
session_start();
include 'connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $name_comp = $_POST['company_name'];
        /*$sn_compa = $_POST['sn_compa'];
        $category_comp = $_POST['category_comp'];
        $pay_comp = $_POST['pay_comp'];*/

        $nb_colis = $_POST['nb_colis'];
        $poids = $_POST['poids'];
        $qt = $_POST['qt'];
        $s_n = $_POST['s_n'];
        $designation = $_POST['designation'];
        $type_p = $_POST['type_p'];

       

        $n_facture = $_POST['n_facture'];
        $date_expir = $_POST['date_expiration'];
        $regi_pre = $_POST['regi_pre'];
        $regi_pre_old = $_POST['regi_pre_old'];
        //$num_regi_pre = $_POST['num_regi_pre'];
        $region = $_POST['region'];

        $num_declaration = $_POST['num_declaration'];
        $declaration = $_POST['declaration'];
        $date_declaration = $_POST['date_declaration'];


        /*$n_at = $_POST['n_at'];
        $regine = $_POST['regine'];
        $echeance = $_POST['echeance'];
        $ref_contrat = $_POST['ref_contrat'];*/

        $conn->beginTransaction();

       /* $stmt = $conn->prepare("INSERT INTO comp (name_compa, sn_compa, category_compa, pay_comp) 
        VALUES (?, ?, ?, ?)");
        $stmt->execute([$name_comp, $sn_compa, $category_comp, $pay_comp]);

        $comp_id = $conn->lastInsertId();*/

        $stmt = $conn->prepare("INSERT INTO products (number_colis, qt, poids, designation, s_n) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nb_colis, $qt, $poids, $designation, $s_n]);

        $products_id = $conn->lastInsertId();
        
        $stmt = $conn->prepare("INSERT INTO facture (n_facture, date_expi, regi_pre, regi_pre_old, region) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$n_facture, $date_expir, $regi_pre, $regi_pre_old, $region]);

        $facture_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO orders (id_product, id_factu, name_compa, type_p, num_declaration, declaration, date_declaration) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$products_id, $facture_id, $name_comp, $type_p, $num_declaration, $declaration, $date_declaration]);

        $conn->commit();

        echo "<script>alert('تمت إضافة الطلب بنجاح!'); window.location.href='dashboard.php';</script>";

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
    <link rel="stylesheet" href="style.css">
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

            <h1>Add Order</h1>
            <form action="" method="post">
                <div>
                    <h3>Company</h3>
                   <!-- <label>SN Company | رقم الشركة</label>
                    <input type="number" name="sn_compa" required>

                    <label>Payment Company | الدفع لشركة</label>
                    <select name="pay_comp" id="">
                        <option value="">--select payment--</option>
                        <option value="payment">Yes</option>
                        <option value="nopayment">No</option>
                    </select>-->
                    <label>Company Name | إسم الشركة</label>
                    <input type="text" name="company_name" required>

                    <label>Type Product | نوع السلعة</label>
                    <select name="type_p" id="" required>
                        <option value="">--select type--</option>
                        <option value="exports">Exports</option>
                        <option value="imports">Import</option>
                    </select>

                    <label>N-AT | الصفقة</label>
                    <input type="text" name="n_comp_at">
                </div>

                <div>
                    <h3>Product</h3>

                    <label>Nb-Colis | عدد السلع</label>
                    <input type="number" name="nb_colis" required>

                    <label>Poids | الوزن</label>
                    <input type="number" name="poids" step="0.01" required>

                    <label>QT | الكمية</label>
                    <input type="number" name="qt" required>

                    <label>s_n | رقم التسلسلي</label>
                    <!--<textarea id="" name="s_n" rows="4" cols="40" required></textarea>-->
                    <input type="text" name="s_n" required>

                </div>
                <div>
                    <h3>Facture</h3>
                    <label>N-Facture | رقم الفاتورة</label>
                    <input type="number" name="n_facture" required>

                    <label>Regi-Pre-one | النظام الأولي</label>
                    <input type="text" name="regi_pre_old" required>

                    <label>Regi-Pre | النظام</label>
                    <input type="text" name="regi_pre" required>

                    <label>Designation | الوصف</label>
                    <input type="text" name="designation" required>

                    <label>Region | المنطقة</label>
                    <input type="text" name="region" required>

                    <label>Date-End-Contract | تاريخ إنتهاء العقد</label>
                    <input type="date" name="date_expiration" required>

                   <!-- <label>N-Dec</label>
                    <input type="text" name="n_dec">

                    <label>Regine</label>
                    <input type="text" name="regine">

                    <label>Declaraation</label>
                    <input type="text" name="declaration">

                    

                    

                    <label>S-N</label>
                    <input type="text" name="s_n">

                    <label>N-AT</label>
                    <input type="text" name="n_at">

                    <label>Echeance</label>
                    <input type="date" name="echeance">

                    <label>REF-Contrat</label>
                    <input type="text" name="ref_contrat">-->
                </div>
                <div>
                    <h3>Declaration</h3>
                    <label>N-Declaration | رقم التصريح</label>
                    <input type="number" name="num_declaration" required>

                    <label>Declaration | التصريح</label>
                    <input type="number" name="declaration" required>

                    <label>Date-Declaration | تاريخ التصريح</label>
                    <input type="date" name="date_declaration" required>

                </div>
                <input type="submit" value="Send">
            </form>

        </article>
    </main>
</body>

</html>