<?php
include "connect.php";

// ดึงข้อมูลลูกค้า
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อลูกค้า KIMM1CH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f8ff;
            padding: 20px;
        }

        h2 {
            color: #003366;
            text-align: center;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #cce5ff;
        }

        th {
            background-color: #003366;
            color: #ffcc00;
        }

        tr:nth-child(even) {
            background-color: #e6f2ff;
        }

        tr:hover {
            background-color: #d9edf7;
        }

        @media screen and (max-width: 600px) {
            th, td {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<h2>รายชื่อลูกค้า KIMM1CH</h2>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $count=1; 
                    while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= "$count" ?></td>
                        <td><?= htmlspecialchars($row["username"]) ?></td>
                        <td><?= htmlspecialchars($row["name"]) ?></td>
                        <td><?= htmlspecialchars($row["email"]) ?></td>
                        <td><?= htmlspecialchars($row["phone"]) ?></td>
                        <td><?= htmlspecialchars($row["address"]) ?></td>
                    </tr>
                <?php $count=$count+1; endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6">ไม่พบข้อมูลลูกค้า</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
