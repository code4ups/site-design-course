<?php
$servername = "localhost";
$username = "root"; // Αλλάξτε αν χρειάζεται
$password = ""; // κενό για XAMPP

// Σύνδεση στον MySQL server
$conn = new mysqli($servername, $username, $password);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
  die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

// Δημιουργία βάσης δεδομένων
$sql = "CREATE DATABASE IF NOT EXISTS my_database";
if ($conn->query($sql) === TRUE) {
  echo "Βάση δεδομένων δημιουργήθηκε επιτυχώς<br>";
} else {
  echo "Σφάλμα δημιουργίας βάσης: " . $conn->error . "<br>";
}

// Επιλογή βάσης
$conn->select_db("my_database");

// Δημιουργία πίνακα users
$sql = "CREATE TABLE IF NOT EXISTS users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "Πίνακας users δημιουργήθηκε επιτυχώς<br>";
} else {
  echo "Σφάλμα δημιουργίας πίνακα: " . $conn->error . "<br>";
}

$conn->close();
?>
