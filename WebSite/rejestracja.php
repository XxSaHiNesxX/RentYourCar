<?php
// Połączenie z bazą danych
$servername = "mysql1.ugu.pl";
$username = "db700630";
$password = "projektag";
$dbname = "db700630";
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Pobranie danych z formularza
$login = $_POST['login'];
$haslo = $_POST['haslo'];

// Wstawienie danych do bazy danych
$sql = "INSERT INTO uzytkownicy (login, haslo) VALUES ('$login', '$haslo')";

if ($conn->query($sql) === TRUE) {
echo "Zarejestrowano pomyślnie!";
} else {
echo "Błąd rejestracji: " . $conn->error;
}

$conn->close();
?>