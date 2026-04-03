<?php
// Databaseverbinding
$servername = "localhost";
$username = "root"; // Standaard gebruikersnaam in XAMPP
$password = "";     // Standaard leeg in XAMPP
$dbname = "gebruikers_db"; // Naam van je database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gegevens ophalen
    $achternaam = $_POST['achternaam'];
    $voornaam = $_POST['voornaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // Wachtwoord hashen voor veiligheid
    $hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

    // Gegevens opslaan in de database
    $sql = "INSERT INTO gebruikers (achternaam, voornaam, wachtwoord, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $achternaam, $voornaam, $hashed_wachtwoord, $email);

    if ($stmt->execute()) {
        echo "Nieuwe gebruiker succesvol geregistreerd!";
    } else {
        echo "Fout: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oefenopgave 1</title>
</head>
<body>
    
    <form method="post" action="">
        <div>
        <label for="voornaam">Voornaam:</label>
        <input type="text" id="voornaam" name="voornaam" required>
    </div>
    <div>
        <label for="achternaam">Achternaam:</label>
        <input type="text" id="achternaam" name="achternaam" required>
    </div>
    <div>
        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" name="wachtwoord" id="wachtwoord" required minlength="8">
    </div>
    <div>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <button type="submit">Registreren</button>
</form>

</body>
</html>