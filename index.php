<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hackowanie - RoboDay 2023</title>
    <link href="style.css" rel="stylesheet"/>
</head>
<body><?php
      // Dane do połączenia z bazą danych
      $servername = getenv('MYSQL_HOST');
      $username = getenv('MYSQL_USER');
      $password = getenv('MYSQL_PASSWORD');
      $dbname = getenv('MYSQL_DATABASE');

      // Połączenie z bazą danych
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Sprawdzenie połączenia
      if ($conn->connect_error) {
          die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
      }

      // Rozpoczęcie sesji

      $errorMessage = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = $_POST["username"];
          $password = $_POST["password"];

          // Weryfikacja użytkownika w bazie danych
        $sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "'";
        echo $sql . "<br>";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ustawienie zmiennej sesyjnej, że użytkownik jest zalogowany
            $_SESSION["loggedIn"] = true;
        } else {
            $errorMessage = "wrong credentials";
        }
    }

    // Sprawdzenie, czy użytkownik jest zalogowany na podstawie zmiennej sesyjnej
    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        echo "Congrats! You are now logged in!";
    } else {
        echo '
        <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
          <label>Username</label>
          <input type="text" name="username"><br>
          <label>Password</label>
          <input type="password" name="password"><br>
          <input type="submit" value="Log in">
          </form>';
      }

      // Zamykanie połączenia z bazą danych
      $conn->close();
      ?>
</body>
</html>
