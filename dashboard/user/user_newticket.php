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
<link rel="stylesheet" href="css/dashboard_user_newticket.css">

</head>

<body>
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
<main class="main">
	<div class="responsive-wrapper">
		<div class="main-header">
			<h1>Nouveau Ticket</h1>
		</div>
		<div class="horizontal-tabs">
			<a href="user_profil.php">Mon Profil</a>
			<a href="user_capteur.php">Mes Capteurs</a>
			<a href="user_ticket.php">Mes Tickets</a>
			<a href="user_newticket.php"  class="active">Nouveau Tickets</a>
			<a href="user_mail.php">Contatcer un Administrateur</a>
		</div>
	</div>

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
                <textarea placeholder="Votre message ici ..." id="description" id="description" name="description" required></textarea> 
            </div>
            <div class="clearfix"></div>
            <button type="submit">Envoyer</button>
        </form>
    </div>

</main>
</body>
<script src="js/chatbot.js"></script>

<html>