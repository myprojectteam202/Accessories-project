<?php
$servername = "localhost";
$username = "root"; // اسم المستخدم الافتراضي لـ MySQL في XAMPP
$password = ""; // كلمة المرور الافتراضية فارغة
$dbname = "autodz_db"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>