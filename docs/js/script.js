
// ================================
// 📧 Συνάρτηση Ελέγχου Email
// ================================

function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// Περιμένουμε να φορτωθεί πλήρως η σελίδα πριν τρέξουμε τον κώδικα
document.addEventListener('DOMContentLoaded', function () {

    // ========================
    // 🍔 Burger Menu Λειτουργία
    // ========================

    const hamburger = document.querySelector('.hamburger'); // Επιλογή burger εικονιδίου
    const navLinks = document.querySelector('.nav-links');  // Επιλογή μενού πλοήγησης
    const hamburgerIcon = hamburger.querySelector('i');     // Επιλογή εικονιδίου μέσα στο κουμπί

    hamburger.addEventListener('click', function () {
        navLinks.classList.toggle('open');

        if (hamburgerIcon.classList.contains('fa-bars')) {
            hamburgerIcon.classList.remove('fa-bars');
            hamburgerIcon.classList.add('fa-times');
        } else {
            hamburgerIcon.classList.remove('fa-times');
            hamburgerIcon.classList.add('fa-bars');
        }
    });


    // ============================
    // 🔝 Scroll to Top Λειτουργία
    // ============================

    const scrollButton = document.getElementById("scrollToTopBtn");

    window.onscroll = function () {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollButton.style.display = "block";
        } else {
            scrollButton.style.display = "none";
        }
    };

    scrollButton.onclick = function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    };
// =====================================
// 📧 Διαχείριση Υποβολής Φόρμας Επικοινωνίας
// =====================================

    const form = document.querySelector('#contact-form');
    const messageBox = document.querySelector('#messageBox');

    if (form && messageBox) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Ακύρωση default υποβολής

            // Ανάκτηση τιμών από τα πεδία
            const name = document.querySelector('#name').value.trim();
            const email = document.querySelector('#mail').value.trim();
            const message = document.querySelector('#msg').value.trim();

            // Έλεγχος ότι όλα τα πεδία είναι συμπληρωμένα
            if (!name || !email || !message) {
                showMessage("Παρακαλώ συμπληρώστε όλα τα πεδία.", "error");
                return;
            }

            if (!validateEmail(email)) {
                showMessage("Παρακαλώ εισάγετε έγκυρη διεύθυνση email.", "error");
                return;
            }

            // Δημιουργία αντικειμένου με τα δεδομένα
            const formData = new URLSearchParams();
            formData.append('user_name', name);
            formData.append('user_mail', email);
            formData.append('user_message', message);

            // Αποστολή δεδομένων μέσω Fetch
            fetch('../submit_contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData.toString()
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage(data.message, "success");
                        form.reset(); // Επαναφορά φόρμας μετά από επιτυχία
                    } else {
                        showMessage(data.message, "error");
                    }
                })
                .catch(error => {
                    console.error('Σφάλμα:', error);
                    showMessage("Παρουσιάστηκε σφάλμα. Δοκιμάστε ξανά.", "error");
                });
        });
    }


});

// =========================================
// 👤 Διαχείριση Υποβολής Φόρμας Εγγραφής Χρήστη
// =========================================

const registerForm = document.querySelector('#register-form');
// Χρησιμοποίησε το ίδιο messageBox με τη φόρμα επικοινωνίας
const registerMessageBox = document.querySelector('#registerMessageBox');

if (registerForm && registerMessageBox) {
    registerForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new URLSearchParams();

        [
            'first_name', 'last_name', 'birth_date',
            'street_address', 'city', 'region',
            'mobile', 'email', 'occupation'
        ].forEach(fieldId => {
            const value = document.querySelector(`#${fieldId}`).value.trim();
            formData.append(fieldId, value);
        });

        const email = document.querySelector('#email').value.trim();
        if (!validateEmail(email)) {
            showMessage("Παρακαλώ εισάγετε έγκυρο email.", "error", registerMessageBox);
            return;
        }

        fetch('../register_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, "success", registerMessageBox);
                    registerForm.reset();
                } else {
                    showMessage(data.message, "error", registerMessageBox);
                }
            })
            .catch(error => {
                console.error('Σφάλμα:', error);
                showMessage("Παρουσιάστηκε σφάλμα. Δοκιμάστε ξανά.", "error", registerMessageBox);
            });
    });
}
// ================================
// 📬 Γενική συνάρτηση εμφάνισης μηνύματος
// ================================
function showMessage(text, type, targetElement = null) {
    const box = targetElement || document.querySelector('#messageBox'); // Εάν δεν δοθεί, χρησιμοποίησε το messageBox

    if (!box) return;

    box.textContent = text;
    box.className = '';
    box.classList.add(type === "error" ? "message-error" : "message-success");
    box.style.display = "block";

    setTimeout(() => {
        box.style.display = "none";
    }, 5000);
}

// ================================
// Για την λειτουργία του accordion panel στη σελίδα μαθημάτων
// ================================

    document.querySelectorAll('.accordion-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        // Κλείσε όλα τα panels εκτός από το τρέχον
        document.querySelectorAll('.accordion-btn').forEach(function(otherBtn) {
            if (otherBtn !== btn) {
                otherBtn.classList.remove('active');
                otherBtn.nextElementSibling.style.display = 'none';
            }
        });
        // Εναλλαγή τρέχοντος panel
        btn.classList.toggle('active');
        var panel = btn.nextElementSibling;
        if (panel.style.display === 'block') {
            panel.style.display = 'none';
        } else {
            panel.style.display = 'block';
        }
    });
});

