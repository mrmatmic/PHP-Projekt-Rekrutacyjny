<?php

header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
$_POST = json_decode(array_keys($_POST)[0], true);
$id =  $_POST["id_pracownika"];
$polaczenie = new mysqli("localhost", "root", "", "pracownicy");

if ($polaczenie->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM pracownik WHERE id_pracownika = '$id'";
$wynik = mysqli_query($polaczenie,$sql);
echo "Usunięto rekord";
?>