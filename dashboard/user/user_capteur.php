<?php
session_start();

if ($_SESSION['role'] != 'user') {
    header("Location: ../HealthTravel/login.php");
    exit();
  }


$host = "localhost"; // L'hôte de la base de données
$dbname = "test"; // Le nom de la base de données
$username = "root"; // Le nom d'utilisateur de la base de données
$password = ""; // Le mot de passe de la base de données

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurer les options de PDO pour afficher les erreurs SQL
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Exécution de la requête SQL pour récupérer les valeurs des capteurs
$query = "SELECT value FROM sensor_data";
$stmt = $dbh->prepare($query);
$stmt->execute();
$sensorValues = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Exécution de la requête SQL pour récupérer l'évolution des risques
$query = "SELECT risque FROM sensor_data";
$stmt = $dbh->prepare($query);
$stmt->execute();
$riskValues = $stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <title>HealtTravel | DashBoard</title>
    <link rel="website icon" type="png" href="images/favicon.png">
    <link rel="stylesheet" href="css/dashboard_user.css">
    <link rel="stylesheet" href="css/dashboard_user_capteur.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script src="js/capteur.js"></script>   
</head>
<body>
    <header class="header">
        <div class="header-content responsive-wrapper">
            <div class="header-logo"></div>
            <div class="header-navigation">
                <nav class="header-navigation-links">
                    <a href="dashboard_user.php">DashBoard</a>
                    <a href="#">Acceuil</a>
                </nav>
                <div class="header-navigation-actions">
                    <form action="../../logout.php" method="post" style="display: inline;">
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
    <div class="main">
        <div class="responsive-wrapper">
            <div class="main-header">
                <h1>Capteurs</h1>
            </div>
            <div class="horizontal-tabs">
                <a href="user_profil.php">Mon Profil</a>
                <a href="user_capteur.php" class="active">Mes Capteurs</a>
                <a href="user_ticket.php">Mes Tickets</a>
                <a href="user_newticket.php">Nouveau Tickets</a>
                <a href="user_mail.php">Contatcer un Administrateur</a>
            </div>
        </div>
    </div>
    
    <div class="card-container">
  <div class="card u-clearfix">
    <div class="card-body">
      
      <ul class="screens">
            <li id="s1" class="active">
                <canvas id="mixte1" width="800" height="450"></canvas>
                <script>
                    var ctx1 = document.getElementById("mixte1").getContext('2d');
                    var myChart1 = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: ["Periode 1", "Periode 2", "Periode 3", "Periode 4", "periode 5"],
                            datasets: [{
                                data: <?php echo json_encode($sensorValues); ?>,
                                label: "Réponse capteurs",
                                type: "line",
                                borderColor: "#b9d48d",
                                backgroundColor: "#b9d48d",
                                fill: false
                            }, {
                                data: <?php echo json_encode($riskValues); ?>,
                                label: "Evolution potentiel des risques",
                                borderColor: "#000",
                                backgroundColor: "#000",
                                fill: false
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        stepSize: 100,
                                        beginAtZero: true
                                    }
                                }]
                            },
                            title: {
                                display: true,
                                text: 'Capteur Cardiaque',
                                fontSize: 24
                            }
                        }
                    });
                </script>
            </li>
            <li id="s2" class="left">
                <p>Screen 2</p>
            </li>
            <li id="s3">
                <p>Screen 3</p>
            </li>
            <li id="s4" class="right">
                <p>Screen 4</p>
            </li>
        </ul>
      
    </div>
  </div>
  <div class="card-shadow"></div>
</div>



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

<!-- Intégration JavaScript -->
<script src="js/capteur.js"></script>   

</body>

</html>
