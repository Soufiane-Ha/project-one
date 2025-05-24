<?php
include 'connect/connect.php';

//$stmt = $conn->prepare("SELECT COUNT(*) FROM comp");
//$stmt->execute();
//$total_comp = $stmt->fetchColumn();

$stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE type_input = 'export'");
$stmt->execute();
$total_exports = $stmt->fetchColumn();

$stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE type_input = 'import'");
$stmt->execute();
$total_imports = $stmt->fetchColumn();

?>