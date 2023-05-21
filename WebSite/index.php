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
                <li><a href="index.php">Strona główna</a></li>
                <li><a href="aktoferty.php">Aktualna oferta</a></li>
                <li><a href="logreje.html">Dodaj oferte</a></li>
                <li><a href="kontakt.html">Kontakt</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Oferta</h2>
            <p>W naszej ofercie znajdziesz szeroki wybór samochodów dostępnych do wynajęcia.<br> Oferujemy zarówno auta osobowe, sportowe jak i dostawcze.</p>
            <h2>Nowe modele samochodów</h2>

            <div class="container">
              <div class="row">
                <div class="col-sm-8">
                  <?php echo isset($deleteMsg) ? $deleteMsg : ''; ?>
                  <?php
                  $sql = "SELECT * FROM wypozyczenia ORDER BY datarozpoczecia DESC LIMIT 3";
                  $result = $conn->query($sql);
                  if ($result && $result->num_rows > 0) {
                    while ($datarozpoczecia = $result->fetch_assoc()) {
                  ?>
                      <article>
                        <h3><?= isset($datarozpoczecia['marka']) ? $datarozpoczecia['marka'] : '' ?></h3>
                        <img src="<?= isset($datarozpoczecia['zdjecie']) ? $datarozpoczecia['zdjecie'] : '' ?>" alt="Zdjęcie">
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
