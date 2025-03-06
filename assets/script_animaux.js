document.addEventListener("DOMContentLoaded", function () {
    // Sélection des éléments
    const searchInput = document.getElementById("search");
    const animalCards = document.querySelectorAll(".animal-card");

    // Fonction de recherche
    searchInput.addEventListener("input", function () {
        const searchText = searchInput.value.toLowerCase();

        animalCards.forEach(card => {
            const animalName = card.querySelector("h3").textContent.toLowerCase();
            if (animalName.includes(searchText)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });

    // Gestion des boutons "En savoir plus"
    const detailsButtons = document.querySelectorAll(".details-btn");

    detailsButtons.forEach(button => {
        button.addEventListener("click", function () {
            const animalName = this.parentElement.querySelector("h3").textContent;
            const animalInfo = this.parentElement.querySelector("p").textContent;

            // Création de la pop-up
            const modal = document.createElement("div");
            modal.classList.add("modal");
            modal.innerHTML = `
                <div class="modal-content">
                    <h2>${animalName}</h2>
                    <p>${animalInfo}</p>
                    <button class="close-btn">Fermer</button>
                </div>
            `;

            // Ajout au body
            document.body.appendChild(modal);

            // Gestion de la fermeture
            modal.querySelector(".close-btn").addEventListener("click", function () {
                modal.remove();
            });

            // Fermeture en cliquant en dehors de la pop-up
            modal.addEventListener("click", function (event) {
                if (event.target === modal) {
                    modal.remove();
                }
            });
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const animauxContainer = document.querySelector(".animaux-container");
    const searchInput = document.getElementById("search");

     // Charger les favoris stockés dans le localStorage
     let favoris = JSON.parse(localStorage.getItem("favoris")) || [];


    // Charger les animaux depuis le fichier JSON
    fetch("animaux.json")
        .then(response => response.json())
        .then(animaux => {
            afficherAnimaux(animaux);

            // Filtrer les animaux en temps réel
            searchInput.addEventListener("input", function () {
                const searchText = searchInput.value.toLowerCase();
                const animauxFiltres = animaux.filter(animal => 
                    animal.nom.toLowerCase().includes(searchText)
                );
                afficherAnimaux(animauxFiltres);
            });
        })
        .catch(error => console.error("Erreur de chargement des animaux :", error));

    // Fonction pour afficher les animaux
    function afficherAnimaux(animaux) {
        animauxContainer.innerHTML = ""; // Nettoyer l'affichage avant d'ajouter
        animaux.forEach(animal => {
            const card = document.createElement("div");
            card.classList.add("animal-card");

            card.innerHTML = `
                <img src="${animal.image}" alt="${animal.nom}">
                <h3>${animal.nom}</h3>
                <p>${animal.description}</p>
                <button class="details-btn">En savoir plus</button>
            `;

            animauxContainer.appendChild(card);

            // Ajouter la pop-up
            card.querySelector(".details-btn").addEventListener("click", function () {
                afficherPopup(animal);
            });
              // Ajouter aux favoris
              card.querySelector(".favori-btn").addEventListener("click", function () {
                toggleFavori(animal, this);
              });
        }); 
    }

    // Fonction pour afficher la pop-up
    function afficherPopup(animal) {
        const modal = document.createElement("div");
        modal.classList.add("modal");

        modal.innerHTML = `
            <div class="modal-content">
                <h2>${animal.nom}</h2>
                <img src="${animal.image}" alt="${animal.nom}">
                <p>${animal.description}</p>
                <button class="close-btn">Fermer</button>
            </div>
        `;

        document.body.appendChild(modal);

        modal.querySelector(".close-btn").addEventListener("click", function () {
            modal.remove();
        });

        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.remove();
            }
        });
    }
    // Fonction pour ajouter/retirer des favoris
    function toggleFavori(animal, bouton) {
        const index = favoris.findIndex(fav => fav.nom === animal.nom);

        if (index !== -1) {
            favoris.splice(index, 1); // Supprimer des favoris
            bouton.classList.remove("favori-actif");
        } else {
            favoris.push(animal); // Ajouter aux favoris
            bouton.classList.add("favori-actif");
        }

        // Sauvegarde des favoris dans le localStorage
        localStorage.setItem("favoris", JSON.stringify(favoris));
    }
});

