<?php 
include 'connect/connect.php';
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style_nav.css">

    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

main {
    width: 90%;
    margin: auto;
    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.head_page {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
    padding: 10px;
    border-bottom: 2px solid #ddd;
}

.head_page img {
    width: 80px;
    height: auto;
}

.search-box {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;
}

#search-input {
    width: 50%;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: 0.3s;
}

#search-input:focus {
    border-color: #007bff;
}

#search-btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    background: #007bff;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    margin-left: 10px;
    transition: 0.3s;
}

#search-btn:hover {
    background: #0056b3;
}



button {
    padding: 8px 12px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.delete-btn {
    background: #dc3545;
    color: white;
}

.delete-btn:hover {
    background: #a71d2a;
}

.more-btn {
    background: #28a745;
    color: white;
}

.more-btn:hover {
    background: #1c7430;
}

.edit-btn {
    background: #ffc107;
    color: black;
}

.edit-btn:hover {
    background: #d39e00;
}

@media (max-width: 768px) {
    .search-box {
        flex-direction: column;
        align-items: center;
    }

    #search-input {
        width: 100%;
        margin-bottom: 10px;
    }

    table {
        font-size: 12px;
    }

    th, td {
        padding: 8px;
    }
}

    </style>
    <title>Orther</title>
</head>

<body>
    <main>
        <div class="head_page">
            <img src="image/alg.png" alt="">
            <p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p>
            <img src="image/cus.jpeg" alt="">
        </div>
        
        <div class="search-box">
            <input type="text" id="search-input" placeholder="ابحث عن شركة أو رقم تصريح أو منطقة">
        </div>

        <article class="import-article">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Poids</th>
                        <th>Date Creation</th>
                        <th>QT</th>
                        <th>S/N</th>
                        <th>Declaration</th>
                        <th>Region</th>
                        <th>Date/Dec</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="imports-table">

                </tbody>
            </table>
        </article>
                <div class="nav_botton" 
        style="
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
                    <li><a href="transfert_contrat.php">Transfert Contrat</a></li>
                    <li><a href="recape_dossier.php">Recape Dossier</a></li>
                    <li><a style="background-color:red;" href="recherch.php">Recherch</a></li>
                    <li><a href="#" onclick="noactive()">Track It</a></li>
                    <li><a href="lists.php">Drop-down Lists</a></li>

</ul></div>
    </main>
</body>

<script>document.addEventListener("DOMContentLoaded", function () {
    function fetchImports(search = "") {
        fetch("featch_serch.php?search=" + encodeURIComponent(search))
        .then(response => response.text())
        .then(data => {
            let table = document.getElementById("imports-table");
            if (table) {
                table.innerHTML = data;
            }
        })
        .catch(error => console.error("Error fetching imports:", error));
    }

    fetchImports();

    let searchInput = document.getElementById("search-input");
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            fetchImports(this.value);
        });
    }

    let importsTable = document.getElementById("imports-table");
    if (importsTable) {
        importsTable.addEventListener("click", function (event) {
            let target = event.target;

            if (target.classList.contains("delete-btn")) {
                let id = target.getAttribute("data-id");
                if (confirm("هل أنت متأكد من حذف هذا العنصر؟")) {
                    deleteOrder(id);
                }
            } 
            
            else if (target.classList.contains("more-btn")) {
                let id = target.getAttribute("data-id");
                window.location.href = "details.php?id=" + id;
            } 
            
            else if (target.classList.contains("edit-btn")) {
                let id = target.getAttribute("data-id");
                window.location.href = "edit.php?id=" + id;
            }
        }); 
    }

    function deleteOrder(id) {
        fetch("delete_order.php?id=" + id, { method: "GET" })
        .then(response => response.text())
        .then(data => {
            alert("تم الحذف بنجاح");
            fetchImports(); 
        })
        .catch(error => console.error("Error deleting order:", error));
    }

});


</script>

<script src="js/script.js"></script>

</html>
