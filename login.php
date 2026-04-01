<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Đăng Nhập</h2>

        <form action="process_login.php" method="POST">
            <label for="username">Tên người dùng</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Đăng Nhập</button>
        </form>

        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </div>
</body>
</html>