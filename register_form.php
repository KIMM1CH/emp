<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มสมัครสมาชิก</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mycss.css">
</head>
<body>
    <form action="register.php" method="post">
        <h2 style="text-align : center">แบบฟอร์มสมัครสมาชิก</h2>

        <label for="ID">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="name">Name-Lastname</label>
        <input type="text" name="name" id="name">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="phone">Phone</label>
        <input type="tel" name="phone" id="phone">

        <label for="address">Address</label>
        <textarea name="address" rows="3" required></textarea>

        <div style="text-align : center">
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
