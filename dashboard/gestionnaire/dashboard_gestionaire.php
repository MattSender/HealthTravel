<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
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

$sql = "SELECT id, nom, prenom, mail FROM utilisateur";
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
<link rel="stylesheet" href="css/dashboard_gestionaire.css">
<link rel="stylesheet" href="css/chatbot.css">

</head>

<body>
<header class="header">
	<div class="header-content responsive-wrapper">
		<div class="header-logo">
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
				<a href="#" class="icon-button">
					<i class="ph-gear-bold"></i>
				</a>
				<a href="#" class="icon-button">
					<i class="ph-bell-bold"></i>
				</a>
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
			<h1>Settings</h1>
		</div>
		<div class="horizontal-tabs">
			<a href="#" class="active">Mon Profil</a>
			<a href="#">Mes Capteurs</a>
			<a href="#">Historique de mesures</a>
			<a href="#">Nous Contacter</a>
		</div>
	</div>
	<div class="table-container">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = $result->fetch_assoc()) : ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['nom']; ?></td>
						<td><?php echo $row['prenom']; ?></td>
						<td><?php echo $row['mail']; ?></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>

    <div id="body">


        <!--button-->
        <div id="chat-circle" class="btn btn-raised">
            <div id="chat-overlay"></div>
            <!--<i class="material-icons">android</i>-->
            <img class="chat-circle_robot" src="https://cdn.iconscout.com/icon/free/png-256/robot-86-404724.png">
        </div>

        <!--chat-bot-->
        <div class="chat-box">
            <div class="chat-box-body">
                <!--welcome message-->
                <div class="chat-box-welcome__header">
                    <div class="chat-box__header-text">
                        <p3 class="chat-box-welcome__company-name">ChatBot</p3>
                        <span class="chat-box-toggle"><i class="material-icons">cancel</i></span>
                    </div>

                    <div id="chat-box-welcome__ava">
                        <!--<i class="material-icons">android</i>-->
                        <img class="chat-box-welcome_robot" src="https://cdn.iconscout.com/icon/free/png-256/robot-86-404724.png">
                    </div>
                    <div class="chat-box-welcome__welcome-text">
                        <p>Hi! I'm ChatBot IDA, what can I assist you with?</p>
                    </div>
                    <!--<div id="chat">

                    </div>-->
                </div>




                <!--chat-bot after welcome was toggled-->
                <div id="chat-box__wraper">
                    <div class="chat-box-header">
                        ChatBot
                        <span class="chat-box-toggle"><i class="material-icons">cancel</i></span>
                    </div>



                    <div class="chat-box-overlay">
                    </div>
                    <div class="chat-logs">
                        <div id="cm-msg-0" class="chat-msg bot">
                            <span class="msg-avatar">
                       <!--<i class="material-icons">android</i>-->
                       <img class="chat-box-overlay_robot" src="https://cdn.iconscout.com/icon/free/png-256/robot-86-404724.png">          
                       </span>
                            <div class="cm-msg-text">
                                Hi! I'm ChatBot IDA, what can I assist you with?
                            </div>
                        </div>
                        <!--<div class="text-center"><p>loader 1</p><div class="loader1"></div></div>-->
                        <div class="spin-container">
                            <div class="spiner">
                                <div aria-hidden="true"></div>
                                <div aria-hidden="true"></div>
                                <div aria-hidden="true"></div>
                            </div>
                        </div>



                    </div>
                    <!--chat-log-->
                </div>

            </div>
            <div class="chat-input-box" id="chatLog">
                <form class="chat-input__form">
                   <input type="text" class="chat-input__text" id="chat-input__text" placeholder="Send a message..." /> 
                    <button type="submit" class="chat-submit" id="chat-submit">
                      <i class="material-icons">send</i>
                  </button>
                </form>
                <p6 class="chat-box__sign">powered by deepPiXEL</p6>
            </div>
        </div>
    </div>
    <!-- end live-chat -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--jquery ui-->
    <!--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>-->

<!--     <script src="app.js"></script> -->




</main>
</body>
<script src="js/chatbot.js"></script>

<html>