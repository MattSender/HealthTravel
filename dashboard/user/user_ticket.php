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
			<h1>Vos Tickets</h1>
		</div>
		<div class="horizontal-tabs">
			<a href="user_profil.php">Mon Profil</a>
			<a href="user_capteur.php">Mes Capteurs</a>
			<a href="user_ticket.php" class="active">Mes Tickets</a>
      <a href="user_newticket.php">Nouveau Tickets</a>
      <a href="user_mail.php">Contatcer un Administrateur</a>
		</div>
	</div>


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