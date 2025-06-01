<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εκπαιδευτικός Ιστότοπος Ανάπτυξης Ιστοσελίδων</title>

    <!-- Σύνδεση του εξωτερικού αρχείου CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- Πλοήγηση (Navigation Menu) -->
<nav class="navigation">
    <!-- Λογότυπο -->
    <div class="logo">
        <a href="index.html" class="logo-link">
            <img src="../images/logo.png" alt="Λογότυπο Μάθε Web Development" class="logo-image">
            <span class="logo-text">Σχεδιασμός Ιστοσελίδων</span>
        </a>
    </div>

    <!-- Λίστα Συνδέσμων Πλοήγησης -->
    <ul class="nav-links">
        <li><a href="index.html">Αρχική</a></li>
        <li><a href="about.html">Σχετικά</a></li>
        <li><a href="lessons.html">Μαθήματα</a></li>
        <li><a href="contact.html">Επικοινωνία</a></li>
    </ul>

    <!-- Εικονίδιο Μενού Hamburger για κινητές συσκευές -->
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<!-- Κεντρική Ηρωική Ενότητα (Hero Section) -->
<header class="hero-section">
    <!-- Χρήση κώδικα PHP -->
    <?php
      // Ο πίνακας με τα ονόματα των ημερών στα ελληνικά, ξεκινώντας από Κυριακή (0)
      $days = [
        'Κυριακή', 'Δευτέρα', 'Τρίτη', 'Τετάρτη',
        'Πέμπτη', 'Παρασκευή', 'Σάββατο'
      ];
      // Παίρνουμε τον αριθμό της ημέρας (0=Κυριακή, 6=Σάββατο)
      $dayOfWeek = date('w');
      // Βρίσκουμε το όνομα της ημέρας στα ελληνικά
      $greekDay = $days[$dayOfWeek];
      // Παίρνουμε την ημερομηνία σε μορφή DD/MM/YYYY
      $date = date('d/m/Y');
      // Εμφανίζουμε το μήνυμα
      echo "<p><strong>$greekDay, $date</strong></p>";
    ?>
    <h1>Καλωσήρθατε στο Ψηφιακό Εργαστήρι!</h1>
        <p>Για την Εκπαίδευση σας στον Σχεδιασμό Ιστοσελίδων και Εφαρμογών .</p>

        <!-- Εικόνα Ηρωικής Ενότητας -->
        <img src="../images/website_building.jpg" alt="Κατασκευή Ιστοσελίδας" class="hero-image">
    </header>

    <section class="instructor-message" style="max-width: 1200px; margin: 40px auto; padding: 20px; background: #f0f4f8; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); font-family: 'Georgia', serif; color: #333;">
        <h2 style="color: #1976d2; margin-bottom: 20px;">Ψηφιακό Εργαστήρι - Σχεδιασμός Ιστοσελίδων και Εφαρμογών</h2>
        <p><em>Αθήνα, Μάιος 2025</em></p>
        <p>Αγαπητοί εκπαιδευόμενοι,</p>
        <p><br>Αυτός ο ιστότοπος είναι το δικό σας σημείο συνάντησης και αναζήτησης του πως σχεδιάζεται και αναπτύσσεται στην πράξη ένα site και δεν δημιουργήθηκε απλώς για να σας “μάθει” την ύλη, αλλά για να σας συντροφεύσει στο ταξίδι της γνώσης και της προσωπικής σας εξέλιξης.</p>
        <p>Οι σελίδες αυτές δεν είναι απλώς τεχνικές οδηγίες. Είναι καρπός εμπειρίας, αφοσίωσης και πραγματικής αγάπης για το αντικείμενο – και κυρίως για εσάς που το μελετάτε.</p>
        <p>Κάθε ενότητα, κάθε ερώτηση, κάθε απάντηση δημιουργήθηκε για να σας υποστηρίξει, να ξεδιαλύνει δυσκολίες, να χτίσει αυτοπεποίθηση και να δώσει δομή στην προσπάθειά σας.</p>
        <p>Μη δείτε αυτό το έργο ως μια “υποχρέωση” προς τις εξετάσεις. Δείτε το ως έναν οδηγό που φτιάχτηκε για να σταθεί δίπλα σας.</p>
        <p>Δουλέψτε με τον δικό σας ρυθμό. Σημειώστε. Γράψτε απορίες. Αμφισβητήστε. Δοκιμάστε. Μάθετε.</p>
        <p>Μέσα από αυτό το υλικό δεν προετοιμάζεστε μόνο για να περάσετε μια εξέταση. Προετοιμάζεστε για να αναλάβετε τον ρόλο σας ως σύγχρονοι δημιουργοί του διαδικτύου.</p>
        <p>Εύχομαι η γνώση να γίνει εργαλείο, η προσπάθεια να σας δικαιώσει και αυτή η πορεία να είναι μόνο η αρχή ενός πολύ μεγαλύτερου ταξιδιού.</p>
        <p style="margin-top: 30px;">Με εκτίμηση και πίστη στις δυνατότητές σας,<br>Ο Εκπαιδευτής σας</p>
    </section>

    <!-- Ενότητα: Τι θα μάθετε -->
    <section class="what-you-learn" style="position: relative;">
        <h2 style="display: inline-block; margin-right: 15px;">Τι θα μάθετε</h2>
        <a href="lessons.html" class="main-button fancy-btn" style="vertical-align: middle; font-size: 0.9em; padding: 6px 14px; text-decoration: none;">
        <span class="btn-icon" style="vertical-align: middle; margin-right: 6px;">
          <!-- SVG εικονίδιο βέλους ή κατάλληλο icon -->
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;">
            <path d="M9 18l6-6-6-6" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
            <span class="btn-text" style="vertical-align: middle; color: #fff;">Δες περισσότερα</span>
        </a>

        <div class="learning-topics" style="margin-top: 20px;">

            <!-- Θέμα: HTML5 -->
            <a href="topics/html5-topic.html" class="topic-link">
                <div class="topic">
                    <h3>HTML5</h3>
                    <p>Θα μάθετε να δημιουργείτε τη δομή μιας ιστοσελίδας με HTML5.</p>
                </div>
            </a>

            <!-- Θέμα: CSS3 & Flexbox -->
            <a href="topics/css3-flexbox-topic.html" class="topic-link">
                <div class="topic">
                    <h3>CSS3 & Flexbox</h3>
                    <p>Θα μάθετε να μορφοποιείτε ιστοσελίδες και να δημιουργείτε responsive layouts με Flexbox.</p>
                </div>
            </a>

            <!-- Θέμα: JavaScript -->
            <a href="topics/javascript-topic.html" class="topic-link">
                <div class="topic">
                    <h3>JavaScript</h3>
                    <p>Θα εισαχθείτε στον προγραμματισμό πελάτη (client-side) για διαδραστικές ιστοσελίδες.</p>
                </div>
            </a>

            <!-- Θέμα: PHP & SQL -->
            <a href="topics/php-sql-topic.html" class="topic-link">
                <div class="topic">
                    <h3>PHP & SQL</h3>
                    <p>Θα γνωρίσετε βασικές τεχνικές διαχείρισης διακομιστή (server-side) και βάσεων δεδομένων.</p>
                </div>
            </a>

            <!-- Θέμα: Responsive Ιστοσελίδες -->
            <a href="topics/responsive-topic.html" class="topic-link">
                <div class="topic">
                    <h3>Responsive Ιστοσελίδες</h3>
                    <p>Θα μάθετε να σχεδιάζετε ιστοσελίδες που προσαρμόζονται σε κινητές και άλλες συσκευές.</p>
                </div>
            </a>

        </div>
    </section>

    <!-- Ενότητα: Ποιοι είμαστε
    <section class="about">
        <h2>Ποιοι είμαστε</h2>
        <p>Ο ιστότοπος αυτός δημιουργήθηκε αποκλειστικά για εκπαιδευτικούς σκοπούς, με στόχο να καθοδηγήσει
        νέους προγραμματιστές στα πρώτα τους βήματα στον σχεδιασμό ιστοσελίδων.</p>
        <a href="about.html">
        <img src="../images/about-us.png" alt="Σχετικά με τον Εκπαιδευτικό Ιστότοπο" class="about-image">
        </a>
    </section> -->

    <!-- Υποσέλιδο (Footer) -->
    <footer class="footer">
        <div class="footer-links">
            <p>
                <a href="terms-of-use.html" class="legal-link">Όροι</a>
                <a href="privacy-notice.html" class="legal-link">Δεδομένα</a>
                <a href="cookies-notice.html" class="legal-link">Cookies</a>
                <a href="business-info.html" class="legal-link">Πληροφορίες</a>
            </p>
        </div>

        <div class="social-media-links">
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="social-link">
                <img src="../images/facebook-icon.png" alt="Facebook" class="social-icon">
            </a>
            <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="social-link">
                <img src="../images/tiktok-icon.png" alt="TikTok" class="social-icon">
            </a>
            <a href="https://youtube.com" target="_blank"  rel="noopener noreferrer" class="social-link">
                <img src="../images/youtube-icon.png" alt="YouTube" class="social-icon">
            </a>
        </div>
<!-- Χρήση κώδικα PHP, Αυτόματα κάθε χρόνο θα αλλάζει το έτος χωρίς να το πειράζεις!-->
    <p>© <?php echo date("Y"); ?> Εκπαιδευτικός Ιστότοπος. Όλα τα δικαιώματα διατηρούνται.</p>
</footer>

<!-- Κουμπί για γρήγορη επαναφορά στην κορυφή -->
<a href="#" class="scroll-to-top" id="scrollToTopBtn">&#94;</a>

<!-- Σύνδεση του εξωτερικού αρχείου JavaScript -->
<script src="../js/script.js"></script>
</body>
</html>
