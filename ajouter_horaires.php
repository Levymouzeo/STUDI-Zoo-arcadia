<?php
include 'config.php';

// Récupérer les employés
$sql = "SELECT * FROM employe";
$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll();

// Ajouter un horaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employe_id = $_POST['employe_id'];
    $jour = $_POST['jour'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];

    $sql = "INSERT INTO horaire (employe_id, jour, heure_debut, heure_fin) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employe_id, $jour, $heure_debut, $heure_fin]);

    echo "✅ Horaire ajouté avec succès !";
}
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
    }

    label {
        margin-top: 10px;
    }

    select,
    input {
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

<form method="POST">
    <label>Employé :</label>
    <select name="employe_id" required>
        <?php foreach ($employes as $e) : ?>
            <option value="<?= $e['id'] ?>"><?= $e['nom'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Jour :</label>
    <select name="jour" required>
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <option value="Mercredi">Mercredi</option>
        <option value="Jeudi">Jeudi</option>
        <option value="Vendredi">Vendredi</option>
        <option value="Samedi">Samedi</option>
        <option value="Dimanche">Dimanche</option>
    </select><br>

    <label>Heure de début :</label>
    <input type="time" name="heure_debut" required><br>

    <label>Heure de fin :</label>
    <input type="time" name="heure_fin" required><br>

    <button type="submit">Ajouter</button>
</form>
