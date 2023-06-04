<?php
session_start();

if ($_SESSION['role'] != 'user') {
  header("Location: ../HealthTravel/login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">

  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>

  <!-- Titre de la Page -->
  <title>HealtTravel | DashBoard </title>

  <!-- Intégration de la favicon -->
  <link rel="website icon" type="png" href="images/favicon.png">

  <!-- Intégration CSS -->
  <link rel="stylesheet" href="css/dashboard_user.css">
  <link rel="stylesheet" href="css/dashboard_user_mail.css">
  <link rel="stylesheet" href="../../css/footer.css">
</head>

<body>
  <!-- Haut de page (Nav Bar) -->
  <header class="header">
    <div class="header-content responsive-wrapper">
      <div class="header-logo">
      </div>
      <div class="header-navigation">
        <nav class="header-navigation-links">
          <a href="dashboard_user.php"> DashBoard </a>
          <a href="#"> Acceuil </a>
        </nav>
        <div class="header-navigation-actions">
          <form action="logout.php" method="post" style="display: inline;">
            <button type="submit" name="logout" class="button">
              <i class="ph-lightning-bold"></i>
              <span>Déconnexion</span>
            </button>
          </form>
          <a href="#" class="avatar">
            <img src="https://assets.codepen.io/285131/hat-man.png" alt="" />
          </a>
        </div>
      </div>
      <a href="#" class="button">
        <i class="ph-list-bold"></i>
        <span>Menu</span>
      </a>
    </div>
  </header>
  <!-- Fin Haut de page (Nav Bar) -->

  <main class="main">
    <div class="responsive-wrapper">
      <div class="main-header">
        <h1>Nous faire une demande</h1>
      </div>
      <div class="horizontal-tabs">
        <a href="user_profil.php">Mon Profil</a>
        <a href="user_capteur.php">Mes Capteurs</a>
        <a href="user_ticket.php">Mes Tickets</a>
        <a href="user_newticket.php">Nouveau Tickets</a>
        <a href="user_mail.php" class="active">Contatcer un Administrateur</a>
      </div>
    </div>  


    <div id="section">
      <section class="contact-wrap">
        <form action="send_email.php" class="contact-form" method="POST">
          <div class="col-sm-6">
            <div class="input-block">
              <label for="name">First Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Your name" tabindex="1">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="input-block">
              <label for="name">Last Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Your name" tabindex="2">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="input-block">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" tabindex="3">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="input-block">
              <label for="subject">Message Subject</label>
              <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" tabindex="4">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="input-block textarea">
              <label for="message">Drop your message here</label>
              <textarea rows="3" class="form-control" id="message" name="message" placeholder="Your message" tabindex="5"></textarea>
            </div>
          </div>
          <div class="col-sm-12">
            <button type="submit" class="square-button">Envoyer</button>
          </div>
        </form>
      </section>
    </div>

    <!-- Footer -->
    <footer class="footer-section">  
      <div class="footer">
        <div class="inner-footer">
          <!-- Logo -->
          <div class="footer-items">
            <img src="../../images/logocarreblanc.png" alt="HealthTravel">
          </div>

          <!--  Redirections  -->
          <div class="footer-items">
            <h3>Redirections</h3>
            <div class="border1"></div>
            <ul>
              <a href="#"><li>Accueil</li></a>
              <a href="#"><li>BoiteX</li></a>
              <a href="#"><li>A Propos</li></a>
              <a href="#"><li>FAQ</li></a>
              <a href="#"><li>Contact</li></a>
              <br>
              <a href="cgu.php"><li>CGU - Mentions Légales</li></a>
            </ul>
          </div>

          <!--  Des trucs -->
          <div class="footer-items">
            <h3>Nos Membres</h3>
            <div class="border1"></div>
            <ul>
              <a href="contact.php"><li>Matthieu</li></a>
              <a href="contact.php"><li>Charles</li></a>
              <a href="contact.php"><li>Ali (Guillaume)</li></a>
              <a href="contact.php"><li>Nathan</li></a>
              <a href="contact.php"><li>Louise-Anne</li></a>
              <a href="contact.php"><li>Vianney</li></a>
            </ul>
          </div>

        <!--  Contact -->
          <div class="footer-items">
            <h3>Contact us</h3>
            <div class="border1"></div>
            <ul>
              <li>10 Rue de Vanves, 92130</li>
              <li>07 07 07 07 07</li>
              <li>contact@healthtravel.fr</li>
            </ul> 

            <!--   Reseaux sociaux -->
            <div class="social-media">
              <a href="#"><i class="fi fi-brands-facebook"></i></a>
              <a href="https://www.instagram.com/healthtravelparis/"><i class="fi fi-brands-instagram"></i></a>
              <a href="#"><i class="fi fi-brands-linkedin"></i></a>
            </div> 
          </div>
        </div>

      <!--   Cas Copyright  -->
        <div class="footer-bottom">
          Copyright &copy; HealthTravel  |  APP G7-D  |  2023
        </div>
      </div>
    </footer>
    <!-- Fin Footer -->

  </main>
</body>
</html>
