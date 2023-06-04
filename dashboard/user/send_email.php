<?php

ini_set('SMTP', 'smtp.example.com');
ini_set('smtp_port', 25);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Construction du corps de l'e-mail
    $body = "Nom: $name\n";
    $body .= "Email: $email\n";
    $body .= "Sujet: $subject\n";
    $body .= "Message: $message\n";

    // Envoi de l'e-mail
    $to = 'sifri800@gmail.com';
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "L'e-mail a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
    }
}
?>
