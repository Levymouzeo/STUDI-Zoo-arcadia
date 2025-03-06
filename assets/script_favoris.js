document.addEventListener("DOMContentLoaded", function () {
    const favorisContainer = document.getElementById("favoris-container");

    // Récupérer les favoris stockés
    let favoris = JSON.parse(localStorage.getItem("favoris")) || [];

    if (favoris.length === 0) {
        favorisContainer.innerHTML = "<p>Aucun animal en favori pour le moment.</p>";
        return;
    }

    favoris.forEach(animal => {
        const card = document.createElement("div");
        card.classList.add("animal-card");

        card.innerHTML = `
            <img src="${animal.image}" alt="${animal.nom}">
            <h3>${animal.nom}</h3>
            <p>${animal.description}</p>
        `;

        favorisContainer.appendChild(card);
    });
});
