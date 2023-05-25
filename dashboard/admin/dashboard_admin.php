<?php
session_start();

if ($_SESSION['role'] != 'admin') {
	header("Location: ../../login.php");
	exit();
  }

$host = 'localhost';
$dbname = 'healthtravel';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id_utilisateur,nom,prenom,mail,tel,password,Taille,Poids,Maladie_à_déclarer,adresse,role,Type_de_véhicule,ville,pays,date_naissance FROM utilisateur";
$result = $conn->query($sql);

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
<link rel="stylesheet" href="css/dashboard_admin.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('.delete').on('click', function(){
        var id = $(this).data('id');
        $.post('delete.php', {id: id}, function(){
            location.reload(); 
        });
    });

    $('.edit').on('click', function(){
        var id = $(this).data('id');
        window.location.href = 'edit.php?id=' + id;
    });
});
</script>


</head>

<body>
<header class="header">
	<div class="header-content responsive-wrapper">
		<div class="header-logo">
				<img src="images/logocolor.png" />
		</div>
		<div class="header-navigation">
			<nav class="header-navigation-links">
				<a href="#"> DashBoard </a>
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
	</div>
</header>
<main class="main">
	<div class="responsive-wrapper">
		<div class="main-header">
			<h1>Settings</h1>
		</div>
		<div class="horizontal-tabs">
			<a href="dashboard_admin_profil.php">Mon Profil</a>
			<a href="#">Mes Capteurs</a>
			<a href="#">Historique de mesures</a>
			<a href="#">Tickets</a>
            <a href="#" class="active">Utilisateurs</a>
            <a href="#">Agenda</a>
		</div>
	</div>
	<div class="table-container">
		<input type="text" id="search" placeholder="Rechercher...">
		<table>
			<thead>
				<tr>
					<th>ID</th>
                    <th>Rôle</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = $result->fetch_assoc()) : ?>
					<tr>
						<td><?php echo $row['id_utilisateur']; ?></td>
                        <td><?php echo $row['role']; ?></td>
						<td><?php echo $row['nom']; ?></td>
						<td><?php echo $row['prenom']; ?></td>
						<td><?php echo $row['mail']; ?></td>
						<td><?php echo $row['tel']; ?></td>
						<td>
							<button class="edit" data-id="<?php echo $row['id_utilisateur']; ?>">Modifier</button>
							<button class="delete" data-id="<?php echo $row['id_utilisateur']; ?>">Supprimer</button>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</main>
</body>
<html>