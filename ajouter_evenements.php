<?php
include 'config.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $date_event = $_POST['date_event'];
    $heure = $_POST['heure'];
    $lieu = $_POST['lieu'];

    $sql = "INSERT INTO evenements (nom, description, date_event, heure, lieu) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $date_event, $heure, $lieu]);

    echo "✅ Événement ajouté avec succès !";
    header("Location: liste_evenements.php");
    exit();
}
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 50%;
    }

    label {
        margin-top: 10px;
    }

    input, textarea {
        margin-top: 5px;
        padding: 5px;
        font-size: 1em;
    }

    button {
        margin-top: 10px;
        padding: 10px;
        font-size: 1em;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>

<h2>Ajouter un événement 📅</h2>
<form method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" required><br>

    <label>Description :</label>
    <textarea name="description" required></textarea><br>

    <label>Date :</label>
    <input type="date" name="date_event" required><br>

    <label>Heure :</label>
    <input type="time" name="heure" required><br>

    <label>Lieu :</label>
    <input type="text" name="lieu" required><br>

    <button type="submit">Ajouter</button>
</form>

<a href="liste_evenements.php">🔙 Retour à la liste</a>
