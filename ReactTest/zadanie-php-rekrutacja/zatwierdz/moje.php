<?php
    header('Content-Type: text/html; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $opis = $_POST["opis"];
    $zawod = $_POST["zawod"];
    $dodatek1 = $_POST["dodatek1"];
    $dodatek2 = $_POST["dodatek2"];
    $zna = $_POST["zna"];
    $nazwaserwera = "localhost";
    $login = "root";
    $haslo = "";
    $baza = "pracownicy";
    $mail = new PHPMailer(true);
	$mail->SMTPOptions = array(
    	'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    	)
	);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jantestowy172@gmail.com'; // Your gmail
    $mail->Password = 'pbsvnciewhsovgls';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('jantestowy172@gmail.com'); // Your gmail

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = "Potwierdzenie rejestracji";
$polaczenie = new mysqli($nazwaserwera, $login, $haslo, $baza);

if ($polaczenie->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Połączono z bazą ";
$id = 0;

$sql = "SELECT id_pracownika FROM pracownik ORDER BY id_pracownika DESC LIMIT 1";
$wynik = $polaczenie->query($sql);

if ($wynik->num_rows > 0) {
  while($wiersz = $wynik->fetch_assoc()) {
    $id = intval($wiersz["id_pracownika"]);
    
  }
} 
$id= $id+1;
echo $zawod;
if($zawod == "tester")
{
    $sql = "INSERT INTO pracownik  VALUES ('$id', '$imie', '$nazwisko', '$email', '$opis', 'Tester')";
    $wynik = $polaczenie->query($sql);
    if($zna){
        $sql = "INSERT INTO tester VALUES ('$id','$dodatek1','$dodatek2','tak')";
        $mail->Body = "Dane:<br> Imie: ".$imie."<br> Nazwisko: ".$nazwisko."<br> E-mail: ".$email.
        "<br> Opis: ".$opis."<br> Stanowisko: Tester <br> Systemy testujące: ".$dodatek1."<br> Systemy raportujące: ".$dodatek2.
        "<br> Znasz Selenium? : tak <br>";
    }
    else{
        $sql = "INSERT INTO tester VALUES ('$id','$dodatek1','$dodatek2','nie')";
        $mail->Body = "Dane:<br> Imie: ".$imie."<br> Nazwisko: ".$nazwisko."<br> E-mail: ".$email.
        "<br> Opis: ".$opis."<br> Stanowisko: Tester <br> Systemy testujące: ".$dodatek1."<br> Systemy raportujące: ".$dodatek2.
        "<br> Znasz Selenium? : nie <br>";
    }
    $wynik = $polaczenie->query($sql);
}
else if($zawod == "developer")
{
    $sql = "INSERT INTO pracownik VALUES ('$id', '$imie', '$nazwisko', '$email', '$opis', 'Developer')";
    $wynik = $polaczenie->query($sql);
    if($zna){
        $sql = "INSERT INTO developer VALUES ('$id','$dodatek1','$dodatek2','tak')";
        $mail->Body = "Dane:<br> Imie: ".$imie."<br> Nazwisko: ".$nazwisko."<br> E-mail: ".$email.
        "<br> Opis: ".$opis."<br> Stanowisko: Developer <br> Środowiska IDE: ".$dodatek1."<br> Języki programowania: ".$dodatek2.
        "<br> Znasz SQL? : tak <br>";
    }
    else{
        $sql = "INSERT INTO developer VALUES ('$id','$dodatek1','$dodatek2','nie')";
        $mail->Body = "Dane:<br> Imie: ".$imie."<br> Nazwisko: ".$nazwisko."<br> E-mail: ".$email.
        "<br> Opis: ".$opis."<br> Stanowisko: Developer <br> Środowiska IDE: ".$dodatek1."<br> Języki programowania: ".$dodatek2.
        "<br> Znasz SQL? : nie <br>";
    }
    $wynik = $polaczenie->query($sql);
}
else if($zawod == "projectmanager")
{
    $sql = "INSERT INTO pracownik VALUES ('$id','$imie','$nazwisko','$email','$opis','Project Manager')";
    $wynik = $polaczenie->query($sql);
    if($zna){
        $sql = "INSERT INTO project_manager VALUES ('$id','$dodatek1','$dodatek2','tak')";
        $mail->Body = "Dane:<br> Imie: ".$imie."<br> Nazwisko: ".$nazwisko."<br> E-mail: ".$email.
        "<br> Opis: ".$opis."<br> Stanowisko: Project Manager <br> Metodologie Prowadzenia Projektów: ".$dodatek1."<br> Systemy raportujące: ".$dodatek2.
        "<br> Znasz Scrum? : tak <br>";
    }
    else{
        $sql = "INSERT INTO project_manager VALUES ('$id','$dodatek1','$dodatek2','nie')";
        $mail->Body = "Dane:<br> Imie: ".$imie."<br> Nazwisko: ".$nazwisko."<br> E-mail: ".$email.
        "<br> Opis: ".$opis."<br> Stanowisko: Project Manager <br> Metodologie Prowadzenia Projektów: ".$dodatek1."<br> Systemy raportujące: ".$dodatek2.
        "<br> Znasz Scrum? : nie <br>";
    }
    $wynik = $polaczenie->query($sql);
}
$mail->send();
$polaczenie->close();
    echo "Przysłano maila";
?>