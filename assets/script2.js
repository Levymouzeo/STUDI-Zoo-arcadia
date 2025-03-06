document.addEventListener("DOMContentLoaded", function () {
    // 1️⃣ MENU RESPONSIVE (si tu ajoutes un menu mobile plus tard)
    const menuToggle = document.querySelector(".menu-toggle");
    const nav = document.querySelector("nav ul");

    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            nav.classList.toggle("active");
        });
    }

    // 2️⃣ EFFET DE DÉFILEMENT FLUIDE POUR LES LIENS
    const links = document.querySelectorAll("nav ul li a");

    links.forEach(link => {
        link.addEventListener("click", function (event) {
            if (this.hash !== "") {
                event.preventDefault();
                const hash = this.hash;
                document.querySelector(hash).scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
        });
    });

    // 3️⃣ GESTION DU FORMULAIRE DE RECHERCHE
    const searchBar = document.querySelector(".search-bar input");
    searchBar.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            alert("Fonctionnalité de recherche non encore implémentée !");
        }
    });

    // 4️⃣ AJOUT DYNAMIQUE D'AVIS CLIENTS
    const reviewsContainer = document.querySelector(".reviews");
    const newReviewButton = document.querySelector(".btn-comment");

    if (newReviewButton) {
        newReviewButton.addEventListener("click", function () {
            const newReview = document.createElement("div");
            newReview.classList.add("review");
            newReview.innerHTML = `
                <h3>Visiteur Anonyme ★★★★☆</h3>
                <p>Une belle expérience, les animaux semblent bien traités.</p>
            `;
            reviewsContainer.appendChild(newReview);
        });
    }
});  
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navMenu = document.querySelector("nav ul");

    menuToggle.addEventListener("click", function () {
        navMenu.classList.toggle("active");
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const ticketType = document.getElementById("ticket-type");
    const quantity = document.getElementById("quantity");
    const totalPrice = document.getElementById("total-price");
    const reservationForm = document.getElementById("reservation-form");

    const prices = {
        adulte: 15,
        enfant: 10,
        etudiant: 12,
        senior: 13
    };

    function updateTotal() {
        const selectedType = ticketType.value;
        const ticketPrice = prices[selectedType];
        const ticketQuantity = parseInt(quantity.value);
        totalPrice.textContent = ticketPrice * ticketQuantity;
    }

    ticketType.addEventListener("change", updateTotal);
    quantity.addEventListener("input", updateTotal);

    reservationForm.addEventListener("submit", function(event) {
        event.preventDefault();
        alert("Réservation confirmée ! Un email de confirmation vous sera envoyé.");
    });

    updateTotal(); // Initialisation du prix
});
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionne toutes les sections
    let sections = document.querySelectorAll("section");

    function revealOnScroll() {
        let scrollPosition = window.scrollY + window.innerHeight * 0.8;

        sections.forEach(section => {
            if (section.offsetTop < scrollPosition) {
                section.classList.add("visible");
            }
        });
    }

    window.addEventListener("scroll", revealOnScroll);
    revealOnScroll(); // Pour charger les sections déjà visibles
}); 

document.addEventListener("DOMContentLoaded", function() {
    fetch("events.json")
        .then(response => response.json())
        .then(events => {
            const eventsContainer = document.querySelector(".events-container");
            eventsContainer.innerHTML = ""; // Vider le conteneur avant d'ajouter les événements dynamiquement

            events.forEach(event => {
                const eventCard = document.createElement("div");
                eventCard.classList.add("event-card");

                eventCard.innerHTML = `
                    <img src="${event.image}" alt="${event.title}">
                    <h3>${event.title}</h3>
                    <p><strong>Date :</strong> ${event.date}</p>
                    <p>${event.description}</p>
                    <button class="reserve-btn">Réserver une place</button>
                `;

                eventsContainer.appendChild(eventCard);
            });
        })
        .catch(error => console.error("Erreur lors du chargement des événements :", error));
});
document.addEventListener("DOMContentLoaded", function() {
    fetch("events.json")
        .then(response => response.json())
        .then(events => {
            const eventSelect = document.getElementById("evenement");

            events.forEach(event => {
                const option = document.createElement("option");
                option.value = event.title;
                option.textContent = `${event.title} - ${event.date}`;
                eventSelect.appendChild(option);
            });
        })
        .catch(error => console.error("Erreur lors du chargement des événements :", error));

    // Gestion du formulaire de réservation
    document.getElementById("event-reservation-form").addEventListener("submit", function(event) {
        event.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const selectedEvent = document.getElementById("event").value;

        fetch("reservation.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&event=${encodeURIComponent(selectedEvent)}`
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("reservation-message").textContent = data === "success" ? "✅ Réservation enregistrée !" : "❌ Une erreur s'est produite.";
        })
        .catch(error => console.error("Erreur lors de la réservation :", error));
    });
});

function initMap() {
    var zooLocation = { lat: 48.0172484, lng: -2.1893342 }; // Coordonnées de la Tour Eiffel (remplace avec celles du zoo)
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: zooLocation,
    });
    var marker = new google.maps.Marker({
        position: zooLocation,
        map: map,
    });
} 
document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contact-form");

    contactForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(contactForm);

        fetch("contact.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("response-message").innerHTML = data;
            contactForm.reset(); // Effacer le formulaire après envoi
        })
        .catch(error => console.error("Erreur :", error));
    });
}); 


