<?php
require 'connect/connect.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM orders WHERE id_order = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "تم الحذف بنجاح";
        } else {
            echo "حدث خطأ أثناء الحذف";
        }
    } catch (PDOException $e) {
        echo "خطأ: " . $e->getMessage();
    }
} else {
    echo "معرف غير صالح";
}
?>
