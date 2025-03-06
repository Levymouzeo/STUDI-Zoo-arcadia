<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("Erreur : Aucun identifiant de visite médicale fourni.");
}
    $id = $_GET['id'];

    // Récupérer les infos de la visite
    $sql = "SELECT * FROM visite_medicale WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $visite = $stmt->fetch();
    if (!$visite) {
        die("Erreur : Visite médicale introuvable.");   
        # code...
    }

// Mettre à jour la visite
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_visite = $_POST['date_visite'];
    $observations = $_POST['observations'];

    $sql = "UPDATE visite_medicale SET date_visite = ?, observations = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$date_visite, $observations, $id]);

    echo "✅ Visite médicale mise à jour avec succès !";
    header("Location: liste_visites.php");
    exit();
}
?>
<style>
    form {
        margin: 20px;
        padding: 20px;
        border: 1px solid #333;
        border-radius: 5px;
        width: 300px;
    }

    input, textarea {
        margin: 10px 0;
        padding: 5px;
        width: 100%;
    }

    button {
        padding: 5px 10px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
</style>
<form method="POST">
    <label>Date de la visite :</label>
    <input type="date" name="date_visite" value="<?= $visite['date_visite'] ?>" required><br>

    <label>Observations :</label>
    <textarea name="observations" required><?= $visite['observations'] ?></textarea><br>

    <button type="submit">Modifier</button>
</form> // Path : modifier_visite.php?id=2 ou id=1 // En fonction du nombre de visites médicales dans la base de données.
