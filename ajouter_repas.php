<?php
include 'config.php';

// Récupérer la liste des animaux
$sql = "SELECT id, nom FROM animal";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'];
    $type_nourriture = $_POST['type_nourriture'];
    $quantite = $_POST['quantite'];
    $date_repas = $_POST['date_repas'];

    // Insérer le repas dans la base de données
    $sql = "INSERT INTO repas (animal_id, type_nourriture, quantite, date_repas) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$animal_id, $type_nourriture, $quantite, $date_repas]);

    echo "✅ Repas ajouté avec succès !";
    header("Location: liste_repas.php");
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
</style>
<!-- Formulaire d'ajout de repas -->
<form method="POST">
    <label>Animal :</label>
    <select name="animal_id" required>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>"><?= $a['nom'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Type de nourriture :</label>
    <input type="text" name="type_nourriture" required><br>

    <label>Quantité (grammes) :</label>
    <input type="number" name="quantite" required><br>

    <label>Date du repas :</label>
    <input type="date" name="date_repas" required><br>

    <button type="submit">Ajouter le repas</button>
</form>
