<?php
session_start(); // بدء الجلسة
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من وجود البريد الإلكتروني مسبقًا
    $sql_check = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "<script>alert('البريد الإلكتروني مستخدم بالفعل');</script>";
    } else {
        // إدخال المستخدم الجديد
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            // استرجاع معرف المستخدم الجديد
            $user_id = $conn->insert_id;
            
            // تسجيل الدخول تلقائيًا
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;

            // عرض رسالة النجاح وتوجيه المستخدم إلى index.php
            echo "<script>alert('تم إنشاء الحساب بنجاح!');</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('حدث خطأ أثناء إنشاء الحساب: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Auto DZ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <section id="register">
        <h1 class="section_title">إنشاء حساب</h1>
        <div class="form_register">
            <form action="" method="POST">
                <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                <input type="password" name="password" placeholder="كلمة المرور" required>
                <input type="submit" value="إنشاء حساب">
            </form>
            <p>لديك حساب؟ <a href="login.php">تسجيل الدخول</a></p>
        </div>
    </section>
</body>
</html>