<?php
// Połączenie z bazą danych
$servername = "mysql1.ugu.pl";
$username = "db700630";
$password = "projektag";
$dbname = "db700630";
$conn = new mysqli($servername, $username, $password, $dbname);

// Ustawienie kodowania na UTF-8
header('Content-Type: text/html; charset=utf-8');


// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Pobranie danych z formularza
$login = $_POST['login'];
$haslo = $_POST['haslo'];

// Zapytanie SQL w celu weryfikacji danych logowania
$sql = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='$haslo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Zalogowano pomyślnie!";
    // Przekierowanie do strony logowania po 3 sekundach
  sleep(5);
  header("Location: addoferte.html");
  exit;
} else {
    echo "Błędny login lub hasło.";
}

$conn->close();
?>
