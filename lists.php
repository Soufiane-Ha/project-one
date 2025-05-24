<?php
session_start();
include 'connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $type = $_POST['type'];
        $item = $_POST['item'];

        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO items_list (type, item) 
                                VALUES (?, ?)");
        $stmt->execute([$type, $item]);

        $conn->commit();

        echo "<script>alert('تمت إضافة إختيار بنجاح!'); window.location.href='lists.php';</script>";

    } catch (PDOException $e) {
        echo "خطأ: " . $e->getMessage();
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->prepare("DELETE FROM items_list WHERE id = ?")->execute([$id]);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

$stmt_items = $conn->query("SELECT * FROM items_list ORDER BY date DESC");
$items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
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

        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%; border-collapse: collapse; margin-top: 30px;
        }
        th, td {
            border: 1px solid #ccc; padding: 10px; text-align: center;
        }
        th {
            color: red;
        }
        td a{
            text-decoration: none;
            color: black;
        }
        td a:hover{
            opacity: .2;
        }
        th {
            background: #f2f2f2;
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
    <title>Add Lists</title>
</head>

<body>
    <main>
        <div class="head_page"><img src="image/alg.png" alt="">
            <p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p><img src="image/cus.jpeg"
                alt="">
        </div>
        <article class="dashboard">

            <form action="" method="post">
                <div>

                    <label>Select Type</label>
                    <select name="type" id="type">
                        <option value="">--select type--</option>
                        <option value="bureadiwan">Bureadiwan</option>
                        <option value="client">Client</option>
                        <option value="regime">Regime</option>
                        <option value="regime_president">Regime President</option>
                    </select>
                    <div id="extra-fields" style="display: none; margin-top: 10px;">
                        <label for="item">Choice Item:</label>
                        <input type="text" name="item" placeholder="Enter  You Choice">
                    </div>
                <input type="submit" value="Send">
                </div>
            </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Item</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i =1;
            foreach ($items as $item): 
            ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($item['type']) ?></td>
                    <td><?= htmlspecialchars($item['item']) ?></td>
                    <td>
                        <a href="?delete=<?= $item['id'] ?>" onclick="return confirm('Are you sure Delete This Item?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </article>
        <div class="nav_botton" 
        style="
        display: flex;
        position: fixed;
        bottom: 0;
        }">
            <ul class="nav-list">
                   <li><a  href="dashboard.php">Home</a></li>
                    <li><a  href="add_imports.php">Import</a></li>
                    <li><a href="add_exports.php">Expot</a></li>
                    <li><a href="admission_temproraire.php">Admission Temproraire</a></li>
                    <li><a href="appurement.php">Appurement</a></li>
                    <li><a href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a style="background-color:red;" href="lists.php">Drop-down Lists</a></li>

            </ul>
        </div>
    </main>
</body>
<script>
    document.getElementById('type').addEventListener('change', function () {
        const extraFields = document.getElementById('extra-fields');
        if (this.value === 'bureadiwan' || this.value === 'client' || this.value === 'regime_president' ||this.value === 'regime') {
            extraFields.style.display = 'block';
        } else {
            extraFields.style.display = 'none';
        }
    });
</script>
<script src="js/script.js"></script>

</html>