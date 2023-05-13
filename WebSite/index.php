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
    <title>RentMyCar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <img src="img/logo.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="index.html">Strona główna</a></li>
                <li><a href="aktoferty.html">Aktualna oferta</a></li>
                <li><a href="addoferte.html">Dodaj oferte</a></li>
                <li><a href="kontakt.html">Kontakt</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Oferta</h2>
            <p>W naszej ofercie znajdziesz szeroki wybór samochodów dostępnych do wynajęcia. Oferujemy zarówno auta osobowe, sportowe jak i dostawcze.</p>
            <h2>Nowe modele samochodów</h2>

            <div class="container">
              <div class="row">
                <div class="col-sm-8">
                  <?php echo isset($deleteMsg) ? $deleteMsg : ''; ?>
                  <?php
                  $sql = "SELECT * FROM wypozyczenia ORDER BY data DESC LIMIT 3";
                  $result = $conn->query($sql);
                  if ($result && $result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                  ?>
                      <article>
                        <h3><?= isset($data['marka']) ? $data['marka'] : '' ?></h3>
                        <img src="<?= isset($data['zdjecie']) ? $data['zdjecie'] : '' ?>" alt="Zdjęcie">
                        <p>Moc: <?= isset($data['moc']) ? $data['moc'] : '' ?></p>
                        <p>Pojemność skokowa (silnik): <?= isset($data['pojemnosc']) ? $data['pojemnosc'] : '' ?></p>
                        <p>Rodzaj paliwa: <?= isset($data['paliwo']) ? $data['paliwo'] : '' ?></p>
                        <p>Skrzynia biegów: <?= isset($data['skrzynia']) ? $data['skrzynia'] : '' ?></p>
                        <p>Napęd: <?= isset($data['naped']) ? $data['naped'] : '' ?></p>
                        <p>Rok produkcji: <?= isset($data['rokprodukcji']) ? $data['rokprodukcji'] : '' ?></p>
                        <p>Dodatkowe informacje: <?= isset($data['opis']) ? $data['opis'] : '' ?></p>
                        <form method="POST" action="wynajmnij.php">
                          <input type="hidden" name="marka" value="<?= isset($data['marka']) ? $data['marka'] : '' ?>">
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
        <p>&copy; 2023 RenyMyCar</p>
    </footer>
</body>
</html>
