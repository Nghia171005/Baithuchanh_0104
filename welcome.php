<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chào Mừng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Chào mừng</h2>
        <div class="message success">
            Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </div>
        <p>Bạn đã đăng nhập thành công vào hệ thống.</p>
        <p><a href="logout.php">Đăng xuất</a></p>
    </div>
</body>
</html>