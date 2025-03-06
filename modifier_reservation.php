<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de la réservation
    $sql = "SELECT * FROM reservation WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $reservation= $stmt->fetch();

    if (!$reservation) {
        echo "❌ Erreur : Réservation introuvable.";
        exit();
    }
} else {
    echo "❌ Erreur : Aucun identifiant de réservation fourni.";
    exit();
}

// Mise à jour de la réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visite_id = $_POST['visite_id'];
    $billet_id = $_POST['billet_id'];
    $date_reservation = $_POST['date_reservation'];

    $sql = "UPDATE reservation SET visite_id = ?, billet_id = ?, date_reservation = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$visite_id, $billet_id, $date_reservation, $id]);

    echo "✅ Réservation mise à jour avec succès !";
    header("Location: liste_reservations.php");
    exit();
}
?>
<style>
    form {
        margin-top: 20px;
        border: 1px solid #3333;
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
        background-color: #333;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
<!-- Formulaire de modification -->
<form method="POST">
    <label>Visite_id :</label>
    <input type="number" name="visite_id" value="<?= $reservation['visite_id'] ?>" required><br>

    <label>Billet_id :</label>
    <input type="number" name="billet_id" value="<?= $reservation['billet_id'] ?>" required><br>

    <label>Date de reservation :</label>
    <input type="date" name="date_reservation" value="<?= $reservation['date_reservation'] ?>" required><br>
    <select name="statut" required>
        <option value="Confirmée" <?= ($reservation['statut'] == "Confirmée") ? 'selected' : '' ?>>Confirmée</option>
        <option value="En attente" <?= ($reservation['statut'] == "En attente") ? 'selected' : '' ?>>En attente</option>
        <option value="Annulée" <?= ($reservation['statut'] == "Annulée") ? 'selected' : '' ?>>Annulée</option>
    </select><br>

    <button type="submit">Modifier</button>
</form>
