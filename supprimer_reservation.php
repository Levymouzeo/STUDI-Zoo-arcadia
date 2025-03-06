<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier si la réservation existe
    $sql = "SELECT * FROM reservation WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $reservation = $stmt->fetch();

    if ($reservation) {
        // Supprimer la réservation
        $sql = "DELETE FROM reservation WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        echo "✅ Réservation supprimée avec succès !";
    } else {
        echo "❌ Erreur : Réservation introuvable.";
    }
} else {
    echo "❌ Erreur : Aucun identifiant de réservation fourni.";
}

// Redirection vers la liste des réservations
header("Location: liste_reservations.php");
exit();
?>
