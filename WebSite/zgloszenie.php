<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $rok = $_POST['rok'];
    $cena = $_POST['cena'];
    $opis = $_POST['opis'];
    $zdjecie = $_FILES['zdjecie']['name'];
    $zdjecie_tmp = $_FILES['zdjecie']['tmp_name'];
  
  // tutaj można dodać kod, który wyśle zgłoszenie na e-mail lub zapisze do bazy danych
  
  echo 'Dziękujemy za zgłoszenie!';
}
?>