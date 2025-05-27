<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Σύνδεση
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
  die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

// Ερώτημα SQL
$sql = "SELECT id, name FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<ul>";
  while($row = $result->fetch_assoc()) {
    echo "<li>" . $row["id"] . ": " . $row["name"] . "</li>";
  }
  echo "</ul>";
} else {
  echo "Δεν βρέθηκαν χρήστες.";
}

$conn->close();
?>
