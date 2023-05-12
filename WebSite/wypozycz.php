<?php
$servername = "mysql1.ugu.pl";
$username = "db700630";
$password = "projektag";
$dbname = "db700630";

// połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// sprawdzenie połączenia
if ($conn->connect_error) {
    die("Nieudane połączenie: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marka = $_POST["marka"];
    $koszt = $_POST["koszt"];
    $data = $_POST["data"];
    $kontakt = $_POST["kontakt"];
    $opis = $_POST["opis"];

    $zdjecie_name = $_FILES["zdjecie"]["name"];
    $zdjecie_tmp_name = $_FILES["zdjecie"]["tmp_name"];
    $zdjecie_error = $_FILES["zdjecie"]["error"];

    if ($zdjecie_error === 0) {
        $sciezka = "zdjecia/"; // Ścieżka do katalogu, w którym są zdjęcia
        $nazwa_pliku = basename($_FILES["zdjecie"]["name"]); // Pobierz oryginalną nazwę pliku

        $zdjecie_destination = $sciezka . $nazwa_pliku;
        move_uploaded_file($zdjecie_tmp_name, $zdjecie_destination);
    }
    // zapytanie SQL dodające rekord
    $sql = "INSERT INTO wypozyczenia (marka, zdjecie, koszt, data, kontakt, opis)
            VALUES ('$marka', '$zdjecie_destination', '$koszt', '$data', '$kontakt', '$opis')";

    if ($conn->query($sql) === TRUE) {
        echo "Ogloszenie dodane poprawnie";
        echo "<script>setTimeout(function(){window.location.href='addoferte.html'}, 3000);</script>";
    } else {
        echo "Blad dodawania ogłoszenia: " . $conn->error;
    }
} else {
    // Błąd przesyłania pliku
    echo "Blad przesylania pliku.";
}
?>