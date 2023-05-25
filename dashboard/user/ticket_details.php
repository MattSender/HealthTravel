<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard_user_ticket.php");
    exit();
}

$id = $_GET['id'];

// Connexion à la base de données
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Récupération du ticket correspondant à l'ID
$query = $db->prepare('SELECT * FROM tickets WHERE id = :id');
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$ticket = $query->fetch();

// Vérification si le ticket existe
if (!$ticket) {
    header("Location: dashboard_user_ticket.php");
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
<title>HealtTravel | Ticket Details </title>

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
			</div>
		</div>
	</div>
</header>
<main class="main">
	<div class="main-container responsive-wrapper">
		<h1 class="page-title">Détails du ticket</h1>
		<div class="ticket-details">
			<h2 class="ticket-subject"><?php echo $ticket['id']; ?></h2>
			<p class="ticket-date"><?php echo $ticket['created_at']; ?></p>
			<p class="ticket-description"><?php echo $ticket['description']; ?></p>
			<p class="ticket-status"><?php echo $ticket['user_id']; ?></p>
			<p class="ticket-priority"><?php echo $ticket['summary']; ?></p>
		</div>
	</div>
</main>
</body>
</html>