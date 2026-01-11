<?php
session_start();
include 'connection.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// التحقق من إرسال نموذج الاتصال
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $objet = $_POST['objet'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (nom, email, objet, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nom, $email, $objet, $message);

    if ($stmt->execute()) {
        echo "<script>alert('تم إرسال الرسالة بنجاح!');</script>";
    } else {
        echo "<script>alert('حدث خطأ أثناء إرسال الرسالة: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCESSOIRES GIRLY</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3010b1eaf1.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="logo">
            <p><span>accessoires</span> for girls</p>
        </div>
        <ul class="menu">
            <li><a href="#home">Accueil</a></li>
            <li><a href="#products">Produits</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <a href="logout.php" class="login_btn">LOGOUT</a>
    </header>

    <!-- section Accueil -->
    <section id="home">
        <div class="left">
            <h1>CHOISISSEZ <span>VOTRE STYLE</span></h1>
            <p>اكتشفي تشكيلتنا الجديدة من الإكسسوارات الأنثوية!</p>
            <a href="#products">DÉCOUVRIR</a>
        </div>
        <div class="right">
            <img src="images/5.jpg" alt="إكسسوارات للبنات">
        </div>
    </section>

    <!-- section Produits -->
    <section id="products">
        <h1 class="section_title">Nos Accessoires :</h1>
        <div class="images">
            <ul>
                <li class="car">
                    <div>
                        <img src="images/bage.jpg" alt="حقيبة يد">
                    </div>
                    <span>Sac à Main Élégant</span>
                    <span class="prix">3.000 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                </li>
                <li class="car">
                    <div>
                        <img src="images/9.jpg" alt="عقد">
                    </div>
                    <span>Collier Doré</span>
                    <span class="prix">2.200 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                </li>
                <li class="car">
                    <div>
                        <img src="images/glasses.jpg" alt="نظارات شمسية">
                    </div>
                    <span>Lunettes de Soleil</span>
                    <span class="prix">1.500 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                </li>
                <li class="car">
                    <div>
                        <img src="images/3.jpg" alt="ساعة يد">
                    </div>
                    <span>Montre Féminine</span>
                    <span class="prix">4.200 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                </li>
                <li class="car">
                    <div>
                        <img src="images/4.jpg" alt="سوار">
                    </div>
                    <span>Bracelet Chic</span>
                    <span class="prix">950 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                </li>
                <li class="car">
                    <div>
                        <img src="images/ring.jpg" alt="خاتم">
                    </div>
                    <span>Bague Élégante</span>
                    <span class="prix">1.200 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                </li>
                <li class="car">
                    <div>
                        <img src="images/11.jpg" alt="محفظة">
                    </div>
                    <span>Pochette Stylée</span>
                    <span class="prix">1.800 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                    </li>
                <li class="car">
                    <div>
                        <img src="images/10.jpg" alt="طقم مجوهرات">
                    </div>
                    <span>Set Bijoux</span>
                    <span class="prix">5.000 DA</span>
                    <a href="#">ACHETER MAINTENANT</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- section Services -->
    <section id="services">
        <h1 class="section_title">Nos Services :</h1>
        <div class="list_services">
            <div class="service">
                <h3>Livraison Rapide</h3>
                <p>Nous livrons vos commandes dans les plus brefs délais partout en Algérie</p>
                <a href="#">Demander</a>
            </div>
            <div class="service">
                <h3>Emballage Cadeau</h3>
                <p>Nous offrons un service d'emballage cadeau personnalisé pour vos proches</p>
                <a href="#">Demander</a>
            </div>
            <div class="service">
                <h3>Promotions & Réductions</h3>
                <p>Profitez de nos offres spéciales et réductions chaque semaine</p>
                <a href="#">Demander</a>
            </div>
        </div>
    </section>

    <!-- section Contact -->
    <section id="contact">
        <h1 class="section_title">Contact</h1>
        <div class="Nombre_of_Phone_contact_div">
            <div class="Nombre_of_Phone">
                <h3>Nos Coordonnées</h3>
                <a href="tel:0675572583">Téléphone : 0675572583</a><br>
                <a href="mailto:accessoires.girly@gmail.com">Email : accessoires.girly@gmail.com</a><br>
                <a href="https://facebook.com/accessoires.girly">Facebook : Accessoires Girly</a><br>
                <a href="#">Adresse : Skikda, Algérie</a>
            </div>
            <div class="form_contact">
                <h3>Envoyer un Message</h3>
                <form action="" method="POST">
                    <input type="text" name="nom" placeholder="Nom" required>
                    <input type="email" name="email" placeholder="Adresse Mail" required>
                    <input type="text" name="objet" placeholder="Objet" required>
                    <input type="text" name="message" placeholder="Message" required>
                    <input type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </section>
</body>
</html>