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
<html>
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
        <li><a href="aktoferty.html">Aktualna oferta</a></li>
        <li><a href="addoferte.html">Dodaj oferte</a></li>
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
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Marka</th>
                <th>Zdjęcie</th>
                <th>Koszt</th>
                <th>Data</th>
                <th>Kontakt</th>
                <th>Opis</th>
              </tr>
            </thead>
            <tbody>
  <?php
  echo phpversion();
  $sql = "SELECT * FROM wypozyczenia";
  $result = mysqli_query($conn, $sql);
  $fetchData = mysqli_fetch_all($result, MYSQLI_ASSOC);
  ?>
  <?php if (is_array($fetchData)): ?>
    <?php foreach ($fetchData as $data): ?>
      <tr>
        <td><?= isset($data['marka']) ? $data['marka'] : '' ?></td>
        <td><?= isset($data['zdjecie']) ? $data['zdjecie'] : '' ?></td>
        <td><?= isset($data['koszt']) ? $data['koszt'] : '' ?></td>
        <td><?= isset($data['data']) ? $data['data'] : '' ?></td>
        <td><?= isset($data['kontakt']) ? $data['kontakt'] : '' ?></td>
        <td><?= isset($data['opis']) ? $data['opis'] : '' ?></td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="6"><?= $fetchData ?></td>
    </tr>
  <?php endif; ?>
</tbody>
          </table>
        </div>
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