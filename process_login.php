<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<div class='container'>";
        echo "<div class='message error'>Vui lòng nhập đầy đủ tên người dùng và mật khẩu!</div>";
        echo "<p><a href='login.php'>Quay lại đăng nhập</a></p>";
        echo "</div>";
        exit();
    }

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // So sánh mật khẩu nhập vào với mật khẩu đã băm trong DB
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "<link rel='stylesheet' href='style.css'>";
            echo "<div class='container'>";
            echo "<div class='message success'>Đăng nhập thành công!</div>";
            echo "<p>Đang chuyển đến trang chào mừng...</p>";
            echo "</div>";

            header("refresh:2;url=welcome.php");
            exit();
        } else {
            echo "<link rel='stylesheet' href='style.css'>";
            echo "<div class='container'>";
            echo "<div class='message error'>Đăng nhập thất bại!</div>";
            echo "<p><a href='login.php'>Thử lại</a></p>";
            echo "</div>";
        }
    } else {
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<div class='container'>";
        echo "<div class='message error'>Đăng nhập thất bại!</div>";
        echo "<p><a href='login.php'>Thử lại</a></p>";
        echo "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>