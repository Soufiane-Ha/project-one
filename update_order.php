<?php
include 'connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // التحقق من وجود القيم المطلوبة
    if (isset($_POST["id"], $_POST["name_compa"], $_POST["rep_order"])) {
        $id = intval($_POST["id"]); // تحويل المعرف إلى عدد صحيح
        $name_compa = trim($_POST["name_compa"]); 
        $rep_order = floatval($_POST["rep_order"]); // تحويل السعر إلى رقم عشري

        if (!empty($name_compa) && $rep_order >= 0) {
            try {
                // تحديث البيانات في قاعدة البيانات
                $stmt = $conn->prepare("UPDATE orders SET name_compa = ?, rep_order = ? WHERE id_order = ?");
                $stmt->execute([$name_compa, $rep_order, $id]);

                if ($stmt->rowCount() > 0) {
                    header('Location: other.php');
                    exit();
                } else {
                    echo "لم يتم تحديث أي بيانات، تحقق من التعديلات!";
                }
            } catch (PDOException $e) {
                echo "خطأ أثناء التحديث: " . $e->getMessage();
            }
        } else {
            echo "يرجى ملء جميع الحقول بشكل صحيح!";
        }
    } else {
        echo "البيانات المطلوبة غير مكتملة!";
    }
} else {
    echo "طلب غير صالح!";
}
?>
