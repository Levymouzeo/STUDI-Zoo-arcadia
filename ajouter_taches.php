<?php
include 'config.php'; // Connexion à la base de données

// Récupérer la liste des employés
$sql = "SELECT * FROM employe";
$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $date_tache = $_POST['date_tache'];
    $employe_id = $_POST['employe_id'];

    // Insérer la tâche dans la base de données
    $sql = "INSERT INTO tache (description, date_tache, employe_id) VALUES (:description, :date_tache, :employe_id)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        ':description' => $description,
        ':date_tache' => $date_tache,
        ':employe_id' => $employe_id
    ])) {
        echo "✅ Tâche ajoutée avec succès !";
    } else {
        echo "❌ Erreur lors de l'ajout de la tâche.";
    }
}
?>
<style>
    form {
        margin-top: 20px;
        border: 1px solid #333;
        padding: 10px;
        width: 300px;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input, select {
        margin-top: 5px;
        width: 100%;
        padding: 5px;
    }

    button {
        margin-top: 10px;
        padding: 5px 10px;
    }
</style>
<h2>Ajouter une Tâche</h2>
<form method="POST">
    <label>Description :</label>
    <input type="text" name="description" required><br>

    <label>Date :</label>
    <input type="date" name="date_tache" required><br>

    <label>Employé :</label>
    <select name="employe_id" required>
        <?php foreach ($employes as $emp) : ?>
            <option value="<?= $emp['id'] ?>"><?= $emp['nom'] ?> <?= $emp['prenom'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Ajouter</button>
</form>
