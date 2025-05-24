<?php 
include 'connect/connect.php';

$search = $_GET['search'] ?? '';

$stmt = $conn->prepare(
"SELECT * 
 FROM orders o
 JOIN products p ON p.id_product = o.id_product
 WHERE client LIKE :search 
    OR designation LIKE :search 
    OR regime LIKE :search 
    OR s_n LIKE :search"
);
$stmt->execute(['search' => "%$search%"]); 

$i = 1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <tr>
        <td><?= $i ?></td>
        <td><?= htmlspecialchars($row['client']) ?></td>
        <td><?= htmlspecialchars($row['poids']) ?></td>
        <td><?= htmlspecialchars($row['date_creation']) ?></td>
        <td><?= htmlspecialchars($row['qt']) ?></td>
        <td><?= htmlspecialchars($row['s_n']) ?></td>
        <td><?= htmlspecialchars($row['designation']) ?></td>
        <td><?= htmlspecialchars($row['regime']) ?></td>
        <td><?= htmlspecialchars($row['date_declaration']) ?></td>
        <td>
            <button class="delete-btn" data-id="<?= $row['id_order'] ?>">Delete</button>
            <button class="more-btn" data-id="<?= $row['id_order'] ?>">More</button>
            <button class="edit-btn" data-id="<?= $row['id_order'] ?>">Edit</button>
        </td>
    </tr>
    <?php $i++; endwhile; ?>
