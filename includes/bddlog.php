<?php

$servername = "localhost";
$username = "adminluca";
$password = "admin1234";
$bddname = "Roulette";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$bddname", $username, $password);
  //On définit le mode d'erreur de PDO sur Exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  session_start();
} catch (PDOException $erreur) {
  echo "Erreur : " . $erreur->getMessage();
  die();
}
?>