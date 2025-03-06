<?php
include 'config.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    echo "❌ Erreur : Aucun identifiant d'événement fourni.";
    exit();
}

$id = $_GET['id'];

// Supprimer l'événement
$sql = "DELETE FROM evenements WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

echo "✅ Événement supprimé avec succès !";
header("Location: liste_evenements.php");
exit();
?>
