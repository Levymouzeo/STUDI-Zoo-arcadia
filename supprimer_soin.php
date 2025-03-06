<?php
include 'config.php';

// Vérifier si un ID est passé en paramètre
if (!isset($_GET['id'])) {
    echo "❌ Erreur : Aucun soin sélectionné.";
    exit();
}

$id = $_GET['id'];

// Supprimer le soin
$sql = "DELETE FROM soins WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

echo "✅ Soin supprimé avec succès !";
header("Location: liste_soin.php");
exit();
?>
