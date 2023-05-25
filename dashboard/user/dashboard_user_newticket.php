<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
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
<link rel="stylesheet" href="css/navbar_user.css">
<link rel="stylesheet" type="text/css" href="../../css/navbar.css">

<link rel="stylesheet" href="css/dashboard_user_newticket.css">

</head>

<body>
<!-- Haut de page (Image + Nav Bar) -->
<header id="home">
  <!-- Navbar -->
  <nav class="navbar-container">
    <ul class="nav navbar">
      <li class="nav-item active"><a href="index.php">Accueil</a></li>
      <li class="nav-item"><a href="produit.php">BoiteX</a></li>
      <li class="nav-item"><a href="about.php">A Propos</a></li>
      <li class="nav-item"><a href="faq.php">FAQ</a></li>
      <li class="nav-item"><a href="contact.php">Contact</a></li>
    </ul>
  </nav>
  <!-- Fin Navbar -->
</header>
<!-- Fin Haut de page (Background + Nav Bar) -->


<main class="main">
	<div class="responsive-wrapper">
		<div class="main-header">
			<h1>Settings</h1>
		</div>
		<div class="horizontal-tabs">
			<a href="dashboard_user.php">Mon Profil</a>
			<a href="#">Mes Capteurs</a>
			<a href="#">Historique de mesures</a>
			<a href="dashboard_user_ticket.php">Vos Tickets</a>
      		<a href="dashboard_user_newticket.php" class="active">Nouveau Tickets</a>
		</div>
	</div>    
</main>

    <div class="contact-us">
    <div class="wrapper">
        <h2>Nous Contacter</h2>
        <br>
        <form action="new_ticket.php" method="POST"> 
            <div class="left">
                <input type="text" placeholder="Nom - Prénom">
                <input type="text" placeholder="E-mail">
                <input type="text" id="summary" name="summary" placeholder="Objet du Message" required>
            </div>
            <div class="right">
                <textarea placeholder="Votre message ici ..." id="description" name="description" required></textarea> 
            </div>
            <div class="clearfix"></div>
            <button type="submit">Envoyer</button>
        </form>
    </div>

</main>
</body>
<script src="js/chatbot.js"></script>

<html>