document.addEventListener("DOMContentLoaded", function () {
    // Gestion du formulaire de connexion
    let loginForm = document.getElementById("login-form");
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêcher l'envoi classique du formulaire

            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();
            let errorMessage = document.getElementById("error-message");

            // Vérification de base
            if (email === "" || password === "") {
                errorMessage.textContent = "❌ Veuillez remplir tous les champs.";
                return;
            }

            // Envoi en AJAX au serveur PHP pour la connexion
            fetch("login.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("success")) {
                    window.location.href = "dashboard.php"; // Redirection en cas de succès
                } else {
                    errorMessage.textContent = "❌ Email ou mot de passe incorrect.";
                }
            })
            .catch(error => console.error("Erreur :", error));
        });
    }

    // Gestion du formulaire d'inscription
    let registerForm = document.getElementById("register-form");
    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêcher l'envoi classique du formulaire

            let nom = document.getElementById("nom").value.trim();
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();
            let role = document.getElementById("role").value;
            let errorMessage = document.getElementById("error-message");

            // Vérification de base
            if (nom === "" || email === "" || password === "") {
                errorMessage.textContent = "❌ Veuillez remplir tous les champs.";
                return;
            }

            // Envoi en AJAX au serveur PHP pour l'inscription
            fetch("register.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `nom=${encodeURIComponent(nom)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&role=${encodeURIComponent(role)}`
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("success")) {
                    window.location.href = "login.html"; // Redirection après inscription réussie
                } else {
                    errorMessage.textContent = "❌ Erreur lors de l'inscription.";
                }
            })
            .catch(error => console.error("Erreur :", error));
        });
    }
});