<?php

session_start();

require_once 'DBConnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $carID = $_POST['carID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['kommentar'];

    $SQL ="INSERT INTO Comments 
    (Car_ID, Name, Email, Kommentar) VALUES ('".$carID."', '".$name."', '".$email."', '".$comment."')";
    $pdo->query($SQL);
}

?>