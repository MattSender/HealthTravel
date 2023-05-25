<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, role, nom, prenom, mail FROM login";
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
<link rel="stylesheet" href="css/dashboard_admin_profil.css">

</head>

<body>
<header class="header">
	<div class="header-content responsive-wrapper">
		<div class="header-logo">
				<img src="images/logocolor.png"/>
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
			<a href="#" class="active">Mon Profil</a>
			<a href="#">Mes Capteurs</a>
			<a href="#">Historique de mesures</a>
			<a href="#">Tickets</a>
            <a href="dashboard_admin.php">Utilisateurs</a>
            <a href="#">Agenda</a>
		</div>
	</div>
	<div class="col-md-7 col-xl-8">
<div class="tab-content">
<div class="tab-pane fade show active" id="account" role="tabpanel">
<div class="card">
<div class="card-header">
<div class="card-actions float-right">
<div class="dropdown show">
<a href="#" data-toggle="dropdown" data-display="static">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
<circle cx="12" cy="12" r="1"></circle>
<circle cx="19" cy="12" r="1"></circle>
<circle cx="5" cy="12" r="1"></circle>
</svg>
</a>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
</div>
<h5 class="card-title mb-0">Public info</h5>
</div>
<div class="card-body">
<form>
<div class="row">
<div class="col-md-8">
<div class="form-group">
<label for="inputUsername">Username</label>
<input type="text" class="form-control" id="inputUsername" placeholder="Username">
</div>
<div class="form-group">
<label for="inputUsername">Biography</label>
 <textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself"></textarea>
</div>
</div>
<div class="col-md-4">
<div class="text-center">
<img alt="Andrew Jones" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle img-responsive mt-2" width="128" height="128">
<div class="mt-2">
<span class="btn btn-primary"><svg class="svg-inline--fa fa-upload fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="upload" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path></svg><!-- <i class="fas fa-upload"></i> --> Upload</span>
</div>
<small>For best results, use an image at least 128px by 128px in .jpg format</small>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Save changes</button>
</form>
</div>
</div>
<div class="card">
<div class="card-header">
<div class="card-actions float-right">
<div class="dropdown show">
<a href="#" data-toggle="dropdown" data-display="static">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
<circle cx="12" cy="12" r="1"></circle>
<circle cx="19" cy="12" r="1"></circle>
<circle cx="5" cy="12" r="1"></circle>
</svg>
</a>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
</div>
<h5 class="card-title mb-0">Private info</h5>
</div>
<div class="card-body">
<form>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputFirstName">First name</label>
<input type="text" class="form-control" id="inputFirstName" placeholder="First name">
</div>
<div class="form-group col-md-6">
<label for="inputLastName">Last name</label>
<input type="text" class="form-control" id="inputLastName" placeholder="Last name">
</div>
</div>
<div class="form-group">
<label for="inputEmail4">Email</label>
<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
</div>
<div class="form-group">
<label for="inputAddress">Address</label>
<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
</div>
<div class="form-group">
<label for="inputAddress2">Address 2</label>
<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputCity">City</label>
<input type="text" class="form-control" id="inputCity">
</div>
<div class="form-group col-md-4">
<label for="inputState">State</label>
<select id="inputState" class="form-control">
<option selected="">Choose...</option>
<option>...</option>
</select>
</div>
<div class="form-group col-md-2">
<label for="inputZip">Zip</label>
<input type="text" class="form-control" id="inputZip">
</div>
</div>
<button type="submit" class="btn btn-primary">Save changes</button>
</form>
</div>
</div>
</div>
<div class="tab-pane fade" id="password" role="tabpanel">
<div class="card">
<div class="card-body">
<h5 class="card-title">Password</h5>
<form>
<div class="form-group">
<label for="inputPasswordCurrent">Current password</label>
<input type="password" class="form-control" id="inputPasswordCurrent">
<small><a href="#">Forgot your password?</a></small>
</div>
<div class="form-group">
<label for="inputPasswordNew">New password</label>
<input type="password" class="form-control" id="inputPasswordNew">
</div>
<div class="form-group">
<label for="inputPasswordNew2">Verify password</label>
<input type="password" class="form-control" id="inputPasswordNew2">
</div>
<button type="submit" class="btn btn-primary">Save changes</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div> 
</main>
</body>
<html>