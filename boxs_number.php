<?php
    include 'total_number.php';
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إحصائيات الجمارك</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .container .add_prod {
            text-decoration: none;
            padding: 7px 15px;
            background: #b6b6b6;
            border-radius: .4rem;
            color: white;
            transition: background 0.3s ease, transform 0.2s ease;
            display: inline-block;
        }

        .container .add_prod:hover {
            background: rgb(180, 180, 180);
            transform: scale(1.05);
        }

        .boxs_number {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 235px;
            height: 270px;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            color: #333;
            transition: 0.3s;
            cursor: pointer;
        }

        .boxs_number:hover {
            transform: translateY(-5px);
        }

        .btn{
            width: 100%;
            display: flex;
            gap: 25px;
        }

        .cbtn{
            padding: 6px;
            background: #a9ab56;
            border-radius: .2rem;
            width: 100%;
            text-align: center;
            text-decoration: none;
            color:white;
        }
        .cbtn:hover{
            opacity: 50%;
        }

        .view {
            background: #6e6f43;
        }

        .boxs_number img {
            width: 200px;
            height: 165px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="boxs_number">
                <h3 class="title">Exprsts : <?= $total_exports ?></h3>
                <img src="image/export.jpg" alt="الصادرات">
                <div class="btn">
                    <a href="exports.php" class="cbtn view">View</a>
                </div>
        </div>

        <div class="boxs_number">
                <h3 class="title">Imports : <?= $total_imports ?></h3>
                <img src="image/import.jpg" alt="استيراد">
                <div class="btn">
                    <a href="imports.php" class="cbtn view">View</a>
                </div>
        </div>

        <div class="boxs_number">
                <h3 class="title">Other</h3>
                <img src="image/cou.jpg" alt="جمارك">
                <div class="btn">
                <a href="" class="cbtn view">View</a>
                </div>
                
        </div>

    </div>

</body>

</html>