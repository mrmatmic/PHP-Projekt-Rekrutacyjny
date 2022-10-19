<?php

header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");

$polaczenie = new mysqli("localhost", "root", "", "pracownicy");

if ($polaczenie->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM pracownik ORDER BY id_pracownika";
$wynik = mysqli_query($polaczenie,$sql);
$uzytkownik = $wynik->fetch_all(MYSQLI_ASSOC);
echo json_encode($uzytkownik);
?>