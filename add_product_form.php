<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มเพิ่มสินค้า</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        * {
            box-sizing: border-box;
            font-family: 'Kanit', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00bcd4;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 1rem;
        }

        .input-row {
            display: flex;
            gap: 10px;
            margin-top: 6px;
        }

        .input-row input[type="text"] {
            flex: 1;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 6px;
            background-color: #2c2c2c;
            color: #fff;
        }

        textarea {
            resize: vertical;
        }

        .random-button {
            background-color: #444;
            border: none;
            color: #fff;
            padding: 10px 14px;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
            font-size: 0.9rem;
        }

        .random-button:hover {
            background-color: #666;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background-color: #00bcd4;
            color: #000;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0097a7;
        }

        @media (max-width: 480px) {
            .input-row {
                flex-direction: column;
            }

            .random-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <form class="form-container" action="add_product.php" method="POST" enctype="multipart/form-data">
        <h2>เพิ่มข้อมูลสินค้า</h2>

        <label for="product_id">รหัสสินค้า</label>
        <div class="input-row">
            <input type="text" name="product_id" id="product_id" readonly required>
            <button type="button" class="random-button" onclick="generateProductID()">สุ่มรหัสใหม่</button>
        </div>

        <label for="product_name">ชื่อสินค้า</label>
        <input type="text" name="product_name" id="product_name" required>

        <label for="price">ราคาสินค้า (บาท)</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <label for="details">รายละเอียดสินค้า</label>
        <textarea name="details" id="details" rows="4" required></textarea>

        <label for="image">อัปโหลดรูปภาพสินค้า</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <input type="submit" value="บันทึกสินค้า">
    </form>

    <script>
        function generateProductID() {
            const prefix = "PK";
            const random = Math.floor(100000 + Math.random() * 900000); // ตัวเลข 6 หลัก
            const productID = prefix + random;
            document.getElementById("product_id").value = productID;
        }

        window.onload = generateProductID;
    </script>
</body>
</html>
