<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = strip_tags(trim($_POST["firstname"]));
    $lastname = strip_tags(trim($_POST["lastname"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = trim($_POST["message"]);

    if (empty($firstname) || empty($lastname) || empty($phone) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Merci de remplir tous les champs correctement.";
        exit;
    }

    $recipient = "b.labielle@agence-awam.fr";

    $subject = "Nouveau message de $firstname $lastname";

    $email_content = "Nom : $firstname $lastname\n";
    $email_content .= "Email : $email\n";
    $email_content .= "Téléphone : $phone\n\n";
    $email_content .= "Message :\n$message\n";

    $email_headers = "From: $firstname $lastname <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Merci ! Votre message a bien été envoyé.";
    } else {
        http_response_code(500);
        echo "Une erreur est survenue, veuillez réessayer plus tard.";
    }
} else {
    http_response_code(403);
    echo "Accès interdit.";
}
?>
