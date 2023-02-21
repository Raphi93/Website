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

// Passwort aus der Datenbank abrufen
$sql = "SELECT password FROM passwords ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $password = $row["password"];
} else {
    $password = "";
}

// Überprüfen, ob das eingegebene Passwort korrekt ist
if (isset($_POST['password']) && $_POST['password'] == $password) {
    header('Content-type: application/pdf');
    readfile('data/Zeugnisse_Raphael_Hug_202211.pdf');
} else {
    echo 'Incorrect password';
}

$conn->close();
?>
