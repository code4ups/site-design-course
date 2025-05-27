<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Σύνδεση με βάση δεδομένων
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
  die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

// Προετοιμασμένη δήλωση (Προστασία από SQL injections)
$stmt = $conn->prepare("INSERT INTO users (name) VALUES (?)");
$stmt->bind_param("s", $name);

// Λήψη δεδομένων από τη φόρμα
$name = $_POST['name'];

// Εκτέλεση
if ($stmt->execute()) {
  echo "Ο χρήστης προστέθηκε επιτυχώς!";
} else {
  echo "Σφάλμα: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
