<?php
if (isset($_POST['id']) && isset($_POST['values'])) {
    $id = $_POST['id'];
    $values = $_POST['values'];

    // Assurez-vous d'avoir les informations correctes pour la connexion à la base de données
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

    // Construire la requête de mise à jour en fonction des valeurs modifiées
    $updateSql = "UPDATE utilisateur SET ";
    foreach ($values as $column => $value) {
        $updateSql .= "$column = '$value', ";
    }
    $updateSql = rtrim($updateSql, ', ');
    $updateSql .= " WHERE id_utilisateur = $id";

    // Exécuter la requête de mise à jour
    if ($conn->query($updateSql) === TRUE) {
        echo "L'utilisateur a été mis à jour avec succès dans la base de données.";
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
