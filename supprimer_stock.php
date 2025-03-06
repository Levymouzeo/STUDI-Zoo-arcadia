<?php
include 'config.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    echo "❌ Erreur : Aucun identifiant de stock fourni.";
    exit();
}

$id = $_GET['id'];

// Supprimer le stock
$sql = "DELETE FROM stock_nourriture WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

echo "✅ Stock supprimé avec succès !";
header("Location: liste_stock.php");
exit();
?>
