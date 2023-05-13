<?php
$servername = "mysql1.ugu.pl";
$username = "db700630";
$password = "projektag";
$dbname = "db700630";

// połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// sprawdzenie połączenia
if($conn->connect_error) {
    die("Nieudane połączenie: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>RentMyCar - Aktualna Oferta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
    <img src="img/logo.png" alt="Logo">
    <nav>
      <ul>
        <li><a href="index.html">Strona główna</a></li>
        <li><a href="aktoferty.php">Aktualna oferta</a></li>
        <li><a href="addoferte.html">Dodaj oferte</a></li>
        <li><a href="kontakt.html">Kontakt</a></li>
      </ul>
    </nav>
</header>

<main>
<section>
<div class="container">
    <div class="row">
      <div class="col-sm-8">
        <?php echo isset($deleteMsg) ? $deleteMsg : ''; ?>
        <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Pobierz wartość pola 'marka' z formularza
  $selectedBrand = $_POST['marka'];

  // Przygotuj zapytanie SQL, które wybierze artykuł o wybranej marce
  $sql = "SELECT * FROM wypozyczenia WHERE marka = '$selectedBrand'";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
      // Jeśli znaleziono wynik, można wyświetlić informacje na temat wybranego artykułu
      $data = $result->fetch_assoc();

      // Wyświetlanie informacji na temat wybranego artykułu
      echo "<h3>" . $data['marka'] . "</h3>";
      echo "<img src='" . $data['zdjecie'] . "' alt='Zdjęcie'>";
      echo "<h4>Szczegóły Samochodu</h4>";
      echo "<p>Moc: " . $data['moc'] . "</p>";
      echo "<p>Pojemność skokowa (silnik): " . $data['pojemnosc'] . "</p>";
      echo "<p>Rodzaj paliwa: " . $data['paliwo'] . "</p>";
      echo "<p>Skrzynia biegów: " . $data['skrzynia'] . "</p>";
      echo "<p>Napęd: " . $data['naped'] . "</p>";
      echo "<p>Rok produkcji: " . $data['rokprodukcji'] . "</p>";
      echo "<h4>Szczegóły wynajmu</h4>";
      echo "<p>Koszt: " . $data['koszt'] . "</p>";
      echo "<p>Data: " . $data['data'] . "</p>";
      echo "<p>Kontakt: " . $data['Kontakt'] . "</p>";
      echo "<p>Dodatkowe informacje: " . $data['opis'] . "</p>";
  } else {
      echo "<p>Nie znaleziono wybranego artykułu.</p>";
  }}
        ?>

      </div>
    </div>
  </div>
<form method="POST" action="osoba.php">
  <br><hr><br>
  <p><h4>Dane osoby wynajmującej</h4></p>
  <label for="imie">Imię:</label>
  <input type="text" id="imie" name="imie" required><br>
  <label for="nazwisko">Nazwisko:</label>
  <input type="text" id="nazwisko" name="nazwisko" required><br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br>
  <label for="telefon">Telefon:</label>
  <input type="tel" id="telefon" name="telefon" required><br>
  <label for="message">Uwagi do wynajmu:</label><br>
  <textarea name="message" id="message" rows="5"></textarea><br><br>
  <button type="submit">Akceptuję</button>
</form>
</section>
</main>
<footer>
    &copy; 2023 RentMyCar
</footer>
</body>
</html>