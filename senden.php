<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $empfaenger = "team.alexgaming@icloud.com";
    $betreff = "Neue Nachricht über das Schulorganiser-Kontaktformular";

    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $nachricht = htmlspecialchars($_POST["message"]);

    if (!$email) {
        echo "<p style='font-family: sans-serif; padding: 2rem; color: red;'>Ungültige E-Mail-Adresse.</p>";
        exit;
    }

    $inhalt = "Name: $name\n";
    $inhalt .= "E-Mail: $email\n\n";
    $inhalt .= "Nachricht:\n$nachricht\n";

    $header = "From: $email\r\n";
    $header .= "Reply-To: $email\r\n";

    if (mail($empfaenger, $betreff, $inhalt, $header)) {
        echo "<p style='font-family: sans-serif; padding: 2rem; text-align: center;'>Danke für deine Nachricht, $name!<br>Wir melden uns bald.</p>";
    } else {
        echo "<p style='font-family: sans-serif; padding: 2rem; text-align: center; color: red;'>Beim Senden ist ein Fehler aufgetreten. Bitte später erneut versuchen.</p>";
    }
}
?>
