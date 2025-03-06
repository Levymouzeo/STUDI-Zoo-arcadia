<?php
include 'config.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_nourriture = $_POST['type_nourriture'];
    $quantite = $_POST['quantite'];
    $date_reception = $_POST['date_reception'];

    $sql = "INSERT INTO stock_nourriture (type_nourriture, quantite, date_reception) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$type_nourriture, $quantite, $date_reception]);

    echo "✅ Stock ajouté avec succès !";
    header("Location: liste_stock.php");
    exit();
}
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 30%;
    }

    label {
        margin-top: 10px;
    }

    input, select {
        margin-top: 5px;
        padding: 5px;
    }

    button {
        margin-top: 10px;
        padding: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    a {
        margin-top: 10px;
        text-decoration: none;
        color: #333;
    }
</style>
<!-- Formulaire d'ajout -->
<h2>Ajouter du stock 📦</h2>
<form method="POST">
    <label>Type de nourriture :</label>
    <input type="text" name="type_nourriture" required><br>

    <label>Quantité (kg) :</label>
    <input type="number" name="quantite" required><br>

    <label>Date de réception :</label>
    <input type="date" name="date_reception" required><br>

    <button type="submit">Ajouter</button>
</form>

<a href="liste_stock.php">🔙 Retour à la liste</a>
