<?php
$servername = "mysql1.ugu.pl";
$username = "db700694";
$password = "projektag";
$dbname = "db700694";

// połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// sprawdzenie połączenia
if ($conn->connect_error) {
    die("Nieudane połączenie: " . $conn->connect_error);
}

// Ustawienie kodowania na UTF-8
header('Content-Type: text/html; charset=utf-8');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $koszt = $_POST["koszt"];
    $datarozpoczecia = $_POST["datarozpoczecia"];
    $datazakonczenia = $_POST["datazakonczenia"];
    $kontakt = $_POST["kontakt"];
    $moc = $_POST["moc"];
    $pojemnosc = $_POST["pojemnosc"];
    $paliwo = $_POST["paliwo"];
    $skrzynia = $_POST["skrzynia"];
    $naped = $_POST["naped"];
    $rokprodukcji = $_POST["rokprodukcji"];
    $opis = $_POST["opis"];

    $zdjecie_name = $_FILES["zdjecie"]["name"];
    $zdjecie_tmp_name = $_FILES["zdjecie"]["tmp_name"];
    $zdjecie_error = $_FILES["zdjecie"]["error"];

    if ($zdjecie_error === 0) {
        $sciezka = "zdjecia/"; // Ścieżka do katalogu, w którym przechowujesz zdjęcia
        $nazwa_pliku = basename($_FILES["zdjecie"]["name"]); // Pobierz oryginalną nazwę pliku

        $zdjecie_destination = $sciezka . $nazwa_pliku;
        move_uploaded_file($zdjecie_tmp_name, $zdjecie_destination);
    }
    // zapytanie SQL dodające rekord
    $sql = "INSERT INTO wypozyczenia (id, zdjecie, koszt, datarozpoczecia, datazakonczenia, kontakt, opis, moc, pojemnosc, paliwo, skrzynia, naped, rokprodukcji)
            VALUES ('$id', '$zdjecie_destination', '$koszt', '$datarozpoczecia', '$datazakonczenia', '$kontakt', '$opis' ,'$moc', '$pojemnosc', '$paliwo', '$skrzynia', '$naped', '$rokprodukcji')";

    if ($conn->query($sql) === TRUE) {
        echo "Ogłoszenie dodane poprawnie";
        echo "<script>setTimeout(function(){window.location.href='aktoferty.php'}, 3000);</script>";
    } else {
        echo "Błąd dodawania ogłoszenia: " . $conn->error;
    }
} else {
    // Błąd przesyłania pliku
    echo "Błąd przesyłania pliku.";
}
?>