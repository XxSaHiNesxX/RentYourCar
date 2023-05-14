<?php
// połączenie z bazą danych
$conn = mysqli_connect("mysql1.ugu.pl", "db700630", "projektag", "db700630");

// pobranie nazwy użytkownika i hasła z formularza
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// sprawdzenie, czy nazwa użytkownika nie jest już zajęta
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // nazwa użytkownika jest już zajęta, wyświetl komunikat błędu
  $error = "Nazwa użytkownika jest już zajęta.";
} else {
  // zaszyfrowanie hasła użytkownika
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // dodanie nowego użytkownika do bazy danych
  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
  mysqli_query($conn, $sql);

  // wygenerowanie komunikatu o powodzeniu rejestracji
  $success = "Użytkownik został zarejestrowany pomyślnie.";
}
?>
