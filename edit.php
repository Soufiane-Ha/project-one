<?php
require 'connect/connect.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("رقم الطلب غير صالح");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM orders WHERE id_order = ?");
$stmt->execute([$id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("الطلب غير موجود.");
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <link rel="stylesheet" href="css/style.css">
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

        /*main {
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
        select:focus,
        button:focus {
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
            input[type="submit"],
            button {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<main>
        <div class="head_page"><img src="image/alg.png" alt="">
            <p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p><img src="image/cus.jpeg"
                alt="">
        </div>

    <h1>Update Order Number <?= htmlspecialchars($id) ?></h1>
<article class="dashboard">

    <form action="update_order.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <label>اسم الشركة:</label>
        <input type="text" name="name_compa" value="<?= htmlspecialchars($order['client']) ?>" required>

        <label>Pay:</label>
         <select name="paye" required>
            <option value="<?= htmlspecialchars($order['paye']) ?>"><?= htmlspecialchars($order['paye']) ?></option>
            <option value="yes">Yes</option>
            <option value="non">Non</option>
        </select>

        <label>حالة الطلب:</label>
        <select name="status">
            <option value="قيد المعالجة" <?= ($order['status'] == 'قيد المعالجة') ? 'selected' : '' ?>>قيد المعالجة</option>
            <option value="مكتمل" <?= ($order['status'] == 'مكتمل') ? 'selected' : '' ?>>مكتمل</option>
            <option value="ملغي" <?= ($order['status'] == 'ملغي') ? 'selected' : '' ?>>ملغي</option>
        </select>

        <button type="submit">حفظ التعديلات</button>
        <a href="recherch.php">إلغاء</a>
    </form>
</article>
</main>
</body>
</html>
