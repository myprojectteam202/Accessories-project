<?php
session_start();
include 'connection.php';

// التحقق من وجود مستخدمين في الجدول
$sql_check_users = "SELECT COUNT(*) as user_count FROM users";
$result_check = $conn->query($sql_check_users);
$row = $result_check->fetch_assoc();

if ($row['user_count'] == 0) {
    // إذا لم يكن هناك مستخدمون، توجيه المستخدم للتسجيل
    header("Location: register.php");
    exit();
}

// التحقق من تسجيل الدخول
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// التحقق من إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // استعلام للتحقق من بيانات المستخدم
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // التحقق من كلمة المرور (بدون تشفير مؤقتًا)
        if ($password === $user['password']) {
            // تسجيل الدخول ناجح
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('كلمة المرور غير صحيحة');</script>";
        }
    } else {
        echo "<script>alert('البريد الإلكتروني غير موجود');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Auto DZ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <section id="login">
        <h1 class="section_title">تسجيل الدخول</h1>
        <div class="form_login">
            <form action="" method="POST">
                <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                <input type="password" name="password" placeholder="كلمة المرور" required>
                <input type="submit" value="تسجيل الدخول">
            </form>
            <p>ليس لديك حساب؟ <a href="register.php">إنشاء حساب</a></p>
        </div>
    </section>
</body>
</html>