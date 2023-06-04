<?php
session_start();

// Redirection si pas connecté ou pas user
if ($_SESSION['role'] != 'user') {
  header("Location: ../HealthTravel/login.php");
  exit();
}

// Récupération de l'id utilisateur
$id_utilisateur = $_SESSION['id_utilisateur'];

// Connexion à la base de données
try {
  $host = 'localhost';
  $dbname = 'healthtravel';
  $username = 'root';
  $password = '';
  $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des informations de l'utilisateur
$req = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur');
$req->execute(array('id_utilisateur' => $id_utilisateur));
$user_info = $req->fetch(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $req = $bdd->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, mail = :mail, tel = :tel, Taille = :Taille, Poids = :Poids, maladie = :maladie, adresse = :adresse, voiture = :voiture, ville = :ville, code_postal = :code_postal, age = :age WHERE id_utilisateur = :id');

  $req->execute(array(
      'nom' => $_POST['nom'] ? $_POST['nom'] : $user_info['nom'],
      'prenom' => $_POST['prenom'] ? $_POST['prenom'] : $user_info['prenom'],
      'mail' => $_POST['mail'] ? $_POST['mail'] : $user_info['mail'],
      'tel' => $_POST['tel'] ? $_POST['tel'] : $user_info['tel'],
      'Taille' => $_POST['Taille'] ? $_POST['Taille'] : $user_info['Taille'],
      'Poids' => $_POST['Poids'] ? $_POST['Poids'] : $user_info['Poids'],
      'maladie' => $_POST['maladie'] ? $_POST['maladie'] : $user_info['maladie'],
      'adresse' => $_POST['adresse'] ? $_POST['adresse'] : $user_info['adresse'],
      'voiture' => $_POST['voiture'] ? $_POST['voiture'] : $user_info['voiture'],
      'ville' => $_POST['ville'] ? $_POST['ville'] : $user_info['ville'],
      'code_postal' => $_POST['code_postal'] ? $_POST['code_postal'] : $user_info['code_postal'],
      'age' => $_POST['age'] ? $_POST['age'] : $user_info['age'],
      'id' => $id_utilisateur
  ));
  

  // Actualiser les infos utilisateur
  $req = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = :id');
  $req->execute(array('id' => $id_utilisateur));
  $user_info = $req->fetch();
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
<link rel="stylesheet" href="css/dashboard_user_profil.css">
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
			<h1>Votre Compte</h1>
		</div>
		<div class="horizontal-tabs">
			<a href="user_profil.php" class="active">Mon Profil</a>
			<a href="user_capteur.php">Mes Capteurs</a>
			<a href="user_ticket.php">Mes Tickets</a>
      <a href="user_newticket.php">Nouveau Tickets</a>
      <a href="user_mail.php">Contatcer un Administrateur</a>
		</div>
	</div>    

  <section class="main2">
          <form class="form-profil" action="" method="POST">
            <div class="champ">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?php echo $user_info['nom']; ?>" />
            </div>
            <div class="champ">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $user_info['prenom']; ?>"/>
            </div>
            <div class="champ">
                <label for="age">Age</label>
                <input type="text" id="age" name="age" value="<?php echo $user_info['age']; ?>"/>
            </div>
            <div class="champ">
                <label for="email">Email</label>
                <input type="email" id="mail" placeholder="email@xxx.fr" name="mail" value="<?php echo $user_info['mail']; ?>"/>
            </div>
            <div class="champ">
                <label for="telephone">Téléphone (mobile)</label>
                <input type="text" id="telephone" name="tel" value="<?php echo $user_info['tel']; ?>"/>
            </div>
            <div class="champ">
                <label for="maladie">Maladie</label>
                <input type="text" id="maladie" name="maladie" value="<?php echo $user_info['maladie']; ?>"/>
            </div>
            <div class="champ">
                <label for="Poids">Poid</label>
                <input type="text" id="Poids" name="Poids" value="<?php echo $user_info['Poids']; ?>"/>
            </div>
            <div class="champ">
                <label for="Taille">Taille</label>
                <input type="text" id="Taille" name="Taille" value="<?php echo $user_info['Taille']; ?>"/>
            </div>
            <div class="champ">
                <label for="code_postal">Code postal</label>
                <input type="text" id="codepcode_postalostal" name="code_postal" value="<?php echo $user_info['code_postal']; ?>"/>
            </div>
            <div class="champ">
                <label for="adresse">N° d'adresse</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $user_info['adresse']; ?>"/>
            </div>
            <div class="champ">
                <label for="rue">Rue</label>
                <input type="text" id="rue" name="rue" value="<?php echo $user_info['rue']; ?>"/>
            </div>
            <div class="champ">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" value="<?php echo $user_info['ville']; ?>"/>
            </div>
            <div class="champ">
                <label for="voiture">Modèle du véhicule</label>
                <input type="text" id="voiture" name="voiture" value="<?php echo $user_info['voiture']; ?>"/>
            </div>
            <input class="btn-save" type="submit" value="Enregistrer mes modifications" />
        </form>
    </section>
</main>

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
<html>