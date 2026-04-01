<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Đăng Ký</h2>

        <form action="process_register.php" method="POST">
            <label for="username">Tên người dùng</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Đăng Ký</button>
        </form>

        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>