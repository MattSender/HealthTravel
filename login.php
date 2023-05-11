<?php
session_start();

// Configuration de la base de données
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}

// Inscrivez un nouvel utilisateur
if (isset($_POST['register'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Vérification de l'adresse email
    $check_email = $pdo->prepare("SELECT email FROM login WHERE email = ?");
    $check_email->execute([$email]);

    if ($check_email->rowCount() > 0) {
        $error_message = "Cet email est déjà utilisé.";
    } else {
        // Inscription de l'utilisateur
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = $pdo->prepare("INSERT INTO login (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
        $query->execute([$nom, $prenom, $email, $hashed_password]);

        $success_message = "Inscription réussie !";
    }
}

// Connectez un utilisateur
if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $query = $pdo->prepare("SELECT * FROM login WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: index.php"); // Redirige vers la page du tableau de bord
    } else {
        $error_message = "Email ou mot de passe incorrect.";
    }
}

?>




<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="utf-8">

<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>

<!-- Titre de la Page -->
<title>HealtTravel | Connexion</title>

<!-- Intégration de la favicon -->
<link rel="website icon" type="png" href="images/favicon.png">

<!-- Intégration CSS -->
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/login.css">

</head>
<body>


<!-- Login Form -->
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="login.php" method="post">
            <h1>Inscription</h1>
            <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
            <span>ou utiliser votre email pour vous inscrire</span>
            <input type="text" placeholder="Nom" name="nom" />
            <input type="text" placeholder="Prénom" name="prenom" />
            <input type="email" placeholder="Email" name="email" />
            <input type="password" placeholder="Password" name="password" />
            <button type="submit" name="register">S'inscrire</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
        <form action="login.php" method="post">
            <h1>Connexion</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
				</div>
            <span>ou connectez-vous avec votre compte</span>
            <input type="email" placeholder="Email" name="email" />
            <input type="password" placeholder="Password" name="password" />
            <a href="mdpoublie.html">Mot de passe oublié ?</a>
            <button type="submit" name="login">Se connecter</button>
        </form>
	</div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Bienvenue !</h1>
                <p>Vous avez déjà un compte? Cliquez sur le bouton ci-dessous pour vous connecter!</p>
                <button class="ghost" id="signIn">Se connecter</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hey l'ami !</h1>
                <p>Tu n'as pas encore de compte chez nous? Clique sur le bouton ci-dessous pour t'inscrire!</p>
                <button class="ghost" id="signUp">S'inscrire</button>
            </div>
        </div>
    </div>
</div>


<!-- Fin Login Form -->
<script src="js/login.js"></script>

<!-- Affichage des messages d'erreur et de succès -->
<?php if (isset($error_message)) : ?>
    <div class="error-message">
        <p><?= $error_message ?></p>
    </div>
<?php endif; ?>

<?php if (isset($success_message)) : ?>
    <div class="success-message">
        <p><?= $success_message ?></p>
    </div>
<?php endif; ?>


</body>
</html>