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
$sql = "SELECT id_utilisateur, nom, prenom, mail, tel, password, Taille, Poids, maladie, adresse, role, voiture, ville, code_postal, age FROM utilisateur";
$result = $conn->query($sql);

// Vérifier si la requête de suppression a été envoyée
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Supprimer la ligne correspondante dans la base de données
    $deleteSql = "DELETE FROM utilisateur WHERE id_utilisateur = $id";
    if ($conn->query($deleteSql) === TRUE) {
        echo "L'utilisateur a été supprimé avec succès de la base de données.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $conn->error;
    }
}

// Vérifier si la requête d'ajout d'utilisateur a été envoyée
if (isset($_POST['role']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail'])) {
    $role = $_POST['role'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];

    // Insérer la nouvelle ligne dans la base de données
    $insertSql = "INSERT INTO utilisateur (role, nom, prenom, mail) VALUES ('$role', '$nom', '$prenom', '$mail')";
    if ($conn->query($insertSql) === TRUE) {
        echo "L'utilisateur a été ajouté avec succès à la base de données.";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
    }
}

$conn->close();
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
            $(document).on('click', '.edit', function(e){
                e.stopPropagation(); // Empêche la propagation de l'événement de rechargement de page

                var id = $(this).data('id');
                var row = $(this).closest('tr');

                // Activer le mode édition pour la ligne correspondante
                row.find('.editable').each(function(){
                    var column = $(this).data('column');
                    var value = $(this).text();
                    $(this).html('<input type="text" name="' + column + '" value="' + value + '">');
                });

                // Changer le texte du bouton "Modifier" en "Mettre à jour"
                $(this).text('Mettre à jour');
                $(this).removeClass('edit').addClass('update');
            });

            $(document).on('click', '.update', function(e){
                e.stopPropagation(); // Empêche la propagation de l'événement de rechargement de page

                var id = $(this).data('id');
                var row = $(this).closest('tr');

                // Récupérer les valeurs modifiées depuis les inputs
                var values = {};
                row.find('.editable input').each(function(){
                    var column = $(this).attr('name');
                    var value = $(this).val();
                    values[column] = value;
                });

                // Envoyer la requête AJAX pour mettre à jour la ligne
                $.post('update.php', {id: id, values: values}, function(data){
                    // Mettre à jour la ligne dans le tableau avec les nouvelles valeurs
                    row.find('.editable').each(function(){
                        var column = $(this).data('column');
                        var value = values[column];
                        $(this).text(value);
                    });

                    // Changer le texte du bouton "Mettre à jour" en "Modifier"
                    $('.update').text('Modifier');
                    $('.update').removeClass('update').addClass('edit');
                });
            });

            $(document).on('click', '.delete', function(){
                var id = $(this).data('id');
                var row = $(this).closest('tr');

                // Envoyer la requête AJAX pour supprimer la ligne
                $.post('delete.php', {id: id}, function(){
                    row.remove();
                });
            });

            $('#add-user').on('click', function(){
                // Ajouter une nouvelle ligne au tableau pour l'ajout d'un utilisateur
                var newRow = '<tr>' +
                                '<td></td>' +
                                '<td class="editable" data-column="role"><input type="text" name="role"></td>' +
                                '<td class="editable" data-column="nom"><input type="text" name="nom"></td>' +
                                '<td class="editable" data-column="prenom"><input type="text" name="prenom"></td>' +
                                '<td class="editable" data-column="mail"><input type="text" name="mail"></td>' +
                                '<td><button class="add">Ajouter</button></td>' +
                            '</tr>';

                $('table tbody').append(newRow);
            });

            $(document).on('click', '.add', function(){
                var row = $(this).closest('tr');

                // Récupérer les valeurs saisies pour le nouvel utilisateur
                var role = row.find('[name="role"]').val();
                var nom = row.find('[name="nom"]').val();
                var prenom = row.find('[name="prenom"]').val();
                var mail = row.find('[name="mail"]').val();

                // Envoyer la requête AJAX pour ajouter l'utilisateur à la base de données
                $.post('dashboard_admin.php', {role: role, nom: nom, prenom: prenom, mail: mail}, function(data){
                    // Mettre à jour la ligne dans le tableau avec les nouvelles valeurs
                    row.find('.editable').each(function(){
                        var value = $(this).find('input').val();
                        $(this).text(value);
                    });

                    // Supprimer le bouton "Ajouter" de la colonne d'action
                    row.find('.add').remove();

                    // Recharger la page pour afficher la nouvelle ligne ajoutée
                    location.reload();
                });
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

        <div class="button-container">
            <button id="add-user">Ajouter</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rôle</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id_utilisateur']; ?></td>
                        <td class="editable" data-column="role"><?php echo $row['role']; ?></td>
                        <td class="editable" data-column="nom"><?php echo $row['nom']; ?></td>
                        <td class="editable" data-column="prenom"><?php echo $row['prenom']; ?></td>
                        <td class="editable" data-column="mail"><?php echo $row['mail']; ?></td>
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
</html>
