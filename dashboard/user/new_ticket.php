<?php
session_start();

// Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION['user_id'])) {
  exit();
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Récupération de l'id de l'utilisateur depuis la session
$user_id = $_SESSION['user_id'];

// Traitement du formulaire de création de ticket
if (isset($_POST['summary']) && isset($_POST['description'])) {
  $summary = $_POST['summary'];
  $description = $_POST['description'];

  // Insertion du nouveau ticket dans la base de données
  $query = $db->prepare('INSERT INTO tickets (user_id, summary, description) VALUES (:user_id, :summary, :description)');
  $query->execute(array(
    'user_id' => $user_id,
    'summary' => $summary,
    'description' => $description
  ));

  // Redirection vers la page "Vos tickets"
  header('Location: dashboard_user_ticket.php');
  exit();
}
?>
