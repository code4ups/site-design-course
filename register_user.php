<?php
// Δηλώνουμε ότι η απάντηση αυτού του script θα είναι σε μορφή JSON με UTF-8
header('Content-Type: application/json; charset=utf-8');

// === ΡΥΘΜΙΣΕΙΣ ΣΥΝΔΕΣΗΣ ΜΕ ΒΑΣΗ ΔΕΔΟΜΕΝΩΝ ===
$host = "localhost";
$username = "root";
$password = ""; // ή 'root' για MAMP
$database = "contact_db";

// === ΣΥΝΔΕΣΗ ΜΕ ΤΗ ΒΑΣΗ ===
$conn = new mysqli($host, $username, $password, $database);

// Έλεγχος αποτυχίας σύνδεσης
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Σφάλμα σύνδεσης με τη βάση: " . $conn->connect_error
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

// === ΑΝΑΚΤΗΣΗ ΚΑΙ ΚΑΘΑΡΙΣΜΟΣ ΔΕΔΟΜΕΝΩΝ ΦΟΡΜΑΣ (ΑΠΟΦΥΓΗ XSS) ===
$first_name     = htmlspecialchars(trim($_POST['first_name']));
$last_name      = htmlspecialchars(trim($_POST['last_name']));
$birth_date     = $_POST['birth_date']; // Δεν απαιτείται htmlspecialchars, αλλά θα ελεγχθεί
$street_address = htmlspecialchars(trim($_POST['street_address']));
$city           = htmlspecialchars(trim($_POST['city']));
$region         = htmlspecialchars(trim($_POST['region']));
$mobile         = htmlspecialchars(trim($_POST['mobile']));
$email          = htmlspecialchars(trim($_POST['email']));
$occupation     = htmlspecialchars(trim($_POST['occupation']));

// === ΕΛΕΓΧΟΣ ΚΕΝΩΝ ΠΕΔΙΩΝ ===
if (
    empty($first_name) || empty($last_name) || empty($birth_date) ||
    empty($street_address) || empty($city) || empty($region) ||
    empty($mobile) || empty($email) || empty($occupation)
) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Όλα τα πεδία είναι υποχρεωτικά."
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

// === ΕΛΕΓΧΟΣ EMAIL ===
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Η διεύθυνση email δεν είναι έγκυρη."
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

// === ΠΡΟΕΤΟΙΜΑΣΙΑ SQL (PREPARED STATEMENT ΓΙΑ ΑΠΟΦΥΓΗ SQL INJECTION) ===
$stmt = $conn->prepare("INSERT INTO users
    (first_name, last_name, birth_date, street_address, city, region, mobile, email, occupation)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Σφάλμα στη SQL προετοιμασία: " . $conn->error
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

// === ΔΕΣΜΕΥΣΗ ΜΕΤΑΒΛΗΤΩΝ ===
$stmt->bind_param(
    "sssssssss",
    $first_name,
    $last_name,
    $birth_date,
    $street_address,
    $city,
    $region,
    $mobile,
    $email,
    $occupation
);

// === ΕΚΤΕΛΕΣΗ ΚΑΙ ΕΛΕΓΧΟΣ ΑΠΟΤΕΛΕΣΜΑΤΟΣ ===
if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "✅ Η εγγραφή ολοκληρώθηκε επιτυχώς!"
    ], JSON_UNESCAPED_UNICODE);
} else {
    // Έλεγχος για πιθανό duplicate email
    if ($stmt->errno === 1062) {
        echo json_encode([
            "success" => false,
            "message" => "❌ Το email υπάρχει ήδη. Επιλέξτε διαφορετικό."
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "❌ Σφάλμα κατά την εισαγωγή: " . $stmt->error
        ], JSON_UNESCAPED_UNICODE);
    }
}

// === ΚΑΘΑΡΙΣΜΟΣ ΠΟΡΩΝ ===
$stmt->close();
$conn->close();
?>
