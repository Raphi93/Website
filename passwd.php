<?php
// Verbindung zur Datenbank herstellen
$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (date('w') == 0) {
    // Passwort generieren
    $new_password = bin2hex(random_bytes(8));

    // Passwort in der Datenbank aktualisieren
    $sql = "UPDATE passwords SET password = '$new_password' WHERE id = 1";
    if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully";
    } else {
        echo "Error updating password: " . $conn->error;
    }

    // Passwort per E-Mail senden
    $to = "hug.raphael@gmx.ch";
    $subject = "Neues Passwort";
    $message = "Das neue Passwort lautet: $new_password";
    $headers = "From: raphael.hug@gmx.net";
    mail($to, $subject, $message, $headers);
    }

$conn->close();
?>
