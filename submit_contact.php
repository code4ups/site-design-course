<?php
// Δηλώνουμε ότι η απάντηση αυτού του script θα είναι σε μορφή JSON και με ελληνικούς χαρακτήρες (UTF-8)
header('Content-Type: application/json; charset=utf-8');

// === ΡΥΘΜΙΣΕΙΣ ΣΥΝΔΕΣΗΣ ΜΕ ΤΗ ΒΑΣΗ ΔΕΔΟΜΕΝΩΝ (MySQL/MAMP) ===
$host = "localhost";          // Τοπικός διακομιστής
$username = "root";          // Default όνομα χρήστη στο MAMP
$password = "";          // Default κωδικός πρόσβασης στο XAMPP είναι κενό ενώ στο MAMP είναι το root
$database = "contact_db";    // Όνομα της βάσης δεδομένων

// === ΔΗΜΙΟΥΡΓΙΑ ΣΥΝΔΕΣΗΣ ===
$conn = new mysqli($host, $username, $password, $database);

// === ΕΛΕΓΧΟΣ ΑΝ Η ΣΥΝΔΕΣΗ ΑΠΕΤΥΧΕ ===
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Σφάλμα σύνδεσης: " . $conn->connect_error
    ], JSON_UNESCAPED_UNICODE);
    exit(); // Τερματίζει την εκτέλεση σε περίπτωση σφάλματος
}

// === ΑΝΑΚΤΗΣΗ ΤΙΜΩΝ ΑΠΟ ΤΗ ΦΟΡΜΑ ΚΑΙ ΚΑΘΑΡΙΣΜΟΣ (ΑΠΟΦΥΓΗ XSS) ===
$name = htmlspecialchars(trim($_POST['user_name']));
$email = htmlspecialchars(trim($_POST['user_mail']));
$message = htmlspecialchars(trim($_POST['user_message']));

// === ΕΛΕΓΧΟΙ ΕΓΚΥΡΟΤΗΤΑΣ ΕΙΣΟΔΩΝ ===

// Έλεγχος για κενά πεδία
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode([
        "success" => false,
        "message" => "Όλα τα πεδία είναι υποχρεωτικά."
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

// Έλεγχος εγκυρότητας διεύθυνσης email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "success" => false,
        "message" => "Μη έγκυρη διεύθυνση email."
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

// === ΕΤΟΙΜΑΣΙΑ ΤΗΣ SQL ΕΝΤΟΛΗΣ ΓΙΑ ΚΑΤΑΧΩΡΗΣΗ (PREPARED STATEMENT) ===
$stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Σφάλμα προετοιμασίας SQL: " . $conn->error
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

// === ΔΕΣΜΕΥΣΗ ΜΕΤΑΒΛΗΤΩΝ ΣΤΑ ΕΡΩΤΗΜΑΤΙΚΑ (ΑΣΦΑΛΕΙΑ ΑΠΟ SQL INJECTION) ===
$stmt->bind_param("sss", $name, $email, $message);

// === ΕΚΤΕΛΕΣΗ ΤΗΣ ΕΝΤΟΛΗΣ ΚΑΙ ΕΠΙΣΤΡΟΦΗ ΑΠΟΤΕΛΕΣΜΑΤΟΣ ===
if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "✅ Το μήνυμά σας καταχωρήθηκε επιτυχώς!"
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Σφάλμα κατά την εκτέλεση: " . $stmt->error
    ], JSON_UNESCAPED_UNICODE);
}

// === ΚΑΘΑΡΙΣΜΟΣ ΠΟΡΩΝ ===
$stmt->close();    // Κλείνει η προετοιμασμένη δήλωση
$conn->close();    // Κλείνει η σύνδεση με τη βάση
?>
