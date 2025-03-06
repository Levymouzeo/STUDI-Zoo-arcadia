<?php
include 'config.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    echo "❌ Erreur : Aucun identifiant de repas fourni.";
    exit();
}

$id = $_GET['id'];

// Supprimer le repas
$sql = "DELETE FROM repas WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

echo "✅ Repas supprimé avec succès !";
header("Location: liste_repas.php");
exit();
?>
