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
			<a href="dashboard_user_ticket.php" class="active">Vos Tickets</a>
      <a href="dashboard_user_newticket.php">Nouveau Tickets</a>
		</div>
	</div>    
</main>


    <h1>Vos tickets</h1>
    <table>
      <thead>
        <tr>
          <th>ID du ticket</th>
          <th>ID de l'utilisateur</th>
          <th>Résumé du ticket</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Connexion à la base de données
        $host = 'localhost';
        $dbname = 'test';
        $username = 'root';
        $password = '';
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Récupération des tickets
        $query = $db->query('SELECT * FROM tickets');
        while ($row = $query->fetch()) {
            echo '<tr>';
            echo '<td><a href="ticket_details.php?id=' . $row['id'] . '">' . $row['id'] . '</a></td>';
            echo '<td>' . $row['user_id'] . '</td>';
            echo '<td>' . $row['summary'] . '</td>';
            echo '</tr>';
        }
        ?>
      </tbody>
    </table>

</main>
</body>
<script src="js/chatbot.js"></script>

<html>