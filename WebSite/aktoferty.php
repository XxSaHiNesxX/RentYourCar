<?php
$servername = "mysql1.ugu.pl";
$username = "db700694";
$password = "projektag";
$dbname = "db700694";

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
  <meta name="viewport" content="wdatarozpoczeciath=device-wdatarozpoczeciath, initial-scale=1.0">
</head>
<body>
<header>
    <img src="img/logo.png" alt="Logo">
    <nav>
      <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="aktoferty.php">Aktualna oferta</a></li>
        <li><a href="logreje.html">Dodaj oferte</a></li>
        <li><a href="kontakt.html">Kontakt</a></li>
      </ul>
    </nav>
</header>

<main>
<section>
  <h2>Aktualna oferta</h2>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <?php echo isset($deleteMsg) ? $deleteMsg : ''; ?>
        <?php
        $sql = "SELECT * FROM wypozyczenia ORDER BY datarozpoczecia DESC";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($datarozpoczecia = $result->fetch_assoc()) {
        ?>
            <article>
              <h3><?= isset($datarozpoczecia['marka']) ? $datarozpoczecia['marka'] : '' ?></h3>
              <img src="<?= isset($datarozpoczecia['zdjecie']) ? $datarozpoczecia['zdjecie'] : '' ?>" alt="Zdjęcie">
              <p>Moc: <?= isset($datarozpoczecia['moc']) ? $datarozpoczecia['moc'] : '' ?></p>
              <p>Pojemność skokowa (silnik): <?= isset($datarozpoczecia['pojemnosc']) ? $datarozpoczecia['pojemnosc'] : '' ?></p>
              <p>Rodzaj paliwa: <?= isset($datarozpoczecia['paliwo']) ? $datarozpoczecia['paliwo'] : '' ?></p>
              <p>Skrzynia biegów: <?= isset($datarozpoczecia['skrzynia']) ? $datarozpoczecia['skrzynia'] : '' ?></p>
              <p>Napęd: <?= isset($datarozpoczecia['naped']) ? $datarozpoczecia['naped'] : '' ?></p>
              <p>Rok produkcji: <?= isset($datarozpoczecia['rokprodukcji']) ? $datarozpoczecia['rokprodukcji'] : '' ?></p>
              <p>Dodatkowe informacje: <?= isset($datarozpoczecia['opis']) ? $datarozpoczecia['opis'] : '' ?></p>
              <form method="POST" action="wynajmnij.php">
                <label>Data rozpoczęcia:</label>
                <input type="date" name="datarozpoczecia" required><br></br>
                <label>Data zakończenia:</label>
                <input type="date" name="datazakonczenia" required><br></br>
                <button type="submit">Zarezerwuj</button>
              </form>
            </article>
            <hr> <!-- Przerwa między artykułami -->
        <?php
          }
        } else {
        ?>
          <p>Brak danych</p>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>
</main>
<footer>
    &copy; 2023 RentMyCar
  </footer>
</body>
</html>