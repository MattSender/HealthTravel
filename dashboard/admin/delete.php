<?php
// Assurez-vous que vous avez les informations correctes pour la connexion à la base de données
$host = 'localhost';
$dbname = 'healthtravel';
$username = 'root';
$password = '';

// Établir la connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier si la connexion a échoué
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'ID de l'utilisateur à supprimer est présent dans les données postées
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Supprimer la ligne correspondante dans la base de données
    $sql = "DELETE FROM utilisateur WHERE id_utilisateur = $id";
    if ($conn->query($sql) === TRUE) {
        echo "L'utilisateur a été supprimé avec succès de la base de données.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
