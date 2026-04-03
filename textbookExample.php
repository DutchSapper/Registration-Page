<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <form class="form-signin" method="post" action="">
        <div class="form-label-group">
            <input type="text" class="form-control" placeholder="Username" required autofocus name="uname">
            <br>
        </div>
        <div class="form-label-group">
            <input type="email" class="form-control" placeholder="Email" required name="mail">
            <br>
        </div>
        <div class="form-label-group">
            <input type="password" class="form-control" placeholder="Password" required name="psw">
            <br>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign up</button>

        <p>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = "DBname";

            // Maak verbinding
            $conn = new mysqli($servername, $username, $password, $dbName);

            // Controleer verbinding
            if ($conn->connect_error) {
                die("Verbinding mislukt: " . $conn->connect_error);
            }

            $value0 = $_POST['uname'];
            $value1 = $_POST['mail'];
            $value2 = $_POST['psw'];

            $hashed_password = password_hash($value2, PASSWORD_DEFAULT);

            if (isset($value0)) {
                // Voeg waarden toe aan de database
                $sql = "INSERT INTO inlog (user, pasw, mails) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $value0, $hashed_password, $value1);

                if ($stmt->execute()) {
                    echo "Account gemaakt op naam: " . $value0 . "<br> ga nu naar <a href='login.php'>login</a>.";
                } else {
                    echo "Niet gelukt: " . $conn->error;
                }
                $stmt->close();
            } else {
                echo "Error: Geen gebruikersnaam opgegeven.";
            }

            $conn->close();
            ?>
        </p>
    </form>
</body>
</html>
