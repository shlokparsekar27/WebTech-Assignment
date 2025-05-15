<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->query("SELECT * FROM expenses ORDER BY date DESC");
    $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($expenses as $expense) {
        echo "<tr id='expense-{$expense['id']}'>";
        echo "<td class='date' data-date='{$expense['date']}'>" . date('M d, Y', strtotime($expense['date'])) . "</td>";
        echo "<td class='description'>" . htmlspecialchars($expense['description']) . "</td>";
        echo "<td class='category'>" . htmlspecialchars($expense['category']) . "</td>";
        echo "<td class='amount'>$" . number_format($expense['amount'], 2) . "</td>";
        echo "<td>";
        echo "<button class='btn btn-sm btn-primary me-2' onclick='editExpense({$expense['id']})'><i class='fas fa-edit'></i> Edit</button>";
        echo "<button class='btn btn-sm btn-danger' onclick='deleteExpense({$expense['id']})'><i class='fas fa-trash'></i> Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    switch($action) {
        case 'add':
            $stmt = $conn->prepare("INSERT INTO expenses (description, amount, category, date) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $_POST['description'],
                $_POST['amount'],
                $_POST['category'],
                $_POST['date']
            ]);
            break;
            
        case 'update':
            $stmt = $conn->prepare("UPDATE expenses SET description = ?, amount = ?, category = ?, date = ? WHERE id = ?");
            $stmt->execute([
                $_POST['description'],
                $_POST['amount'],
                $_POST['category'],
                $_POST['date'],
                $_POST['id']
            ]);
            break;
            
        case 'delete':
            $stmt = $conn->prepare("DELETE FROM expenses WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            break;
    }
    
    echo 'success';
}
?>