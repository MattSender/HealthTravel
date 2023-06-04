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

if (isset($_POST['add_user'])) {
    $role = $_POST['role'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];

    $insertSql = "INSERT INTO utilisateur (role, nom, prenom, mail) VALUES ('$role', '$nom', '$prenom', '$mail')";
    if ($conn->query($insertSql) === TRUE) {
        echo "L'utilisateur a été ajouté avec succès à la base de données.";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
    }
}

$conn->close();
?>
