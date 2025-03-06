<?php include 'config.php'; 

if (!isset($_GET['id'])) { 
    echo "❌ Erreur : Aucun identifiant de paiement fourni."; 
    exit(); 
} 

$id = $_GET['id']; 

// Vérifier si le paiement existe 
$sql = "SELECT * FROM paiement WHERE id = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$id]); 
$paiement = $stmt->fetch(); 

if (!$paiement) { 
    echo "❌ Erreur : Paiement introuvable."; 
    exit(); 
} 

// Supprimer le paiement 
$sql = "DELETE FROM paiement WHERE id = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$id]); 

echo "✅ Paiement supprimé avec succès !"; 
header("Location: liste_paiements.php"); 
exit(); 
?>