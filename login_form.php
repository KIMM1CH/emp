<?php
$errorMsg = '';
if (isset($_GET['error']) && $_GET['error'] == 1) {
    $errorMsg = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Kanit', sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        div {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #2c2c2c;
            border: 1px solid #444;
            border-radius: 6px;
            color: #fff;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            color: #bbbbbb;
            text-decoration: none;
            display: block;
            margin-top: 15px;
        }

        a:hover {
            color: #ffffff;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div>
    <?php if ($errorMsg): ?>
        <p class="error"><?= htmlspecialchars($errorMsg) ?></p>
    <?php endif; ?>

    <h2>เข้าสู่ระบบ</h2>
    <form method="POST" action="check_login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">เข้าสู่ระบบ</button>
    </form>
    <a href="#">ลืมรหัสผ่าน?</a>
</div>

</body>
</html>
