<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<div class='container'>";
        echo "<div class='message error'>Vui lòng nhập đầy đủ thông tin!</div>";
        echo "<p><a href='register.php'>Quay lại</a></p>";
        echo "</div>";
        exit();
    }

    // Kiểm tra username đã tồn tại chưa
    $checkSql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<div class='container'>";
        echo "<div class='message error'>Tên người dùng đã tồn tại!</div>";
        echo "<p><a href='register.php'>Quay lại đăng ký</a></p>";
        echo "</div>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Băm mật khẩu trước khi lưu
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<div class='container'>";
        echo "<div class='message success'>Đăng ký thành công!</div>";
        echo "<p><a href='login.php'>Đi đến trang đăng nhập</a></p>";
        echo "</div>";
    } else {
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<div class='container'>";
        echo "<div class='message error'>Đăng ký thất bại!</div>";
        echo "<p><a href='register.php'>Thử lại</a></p>";
        echo "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>