<?php include 'config.php'; 

// Vérifier si un ID de billet est fourni 
if (!isset($_GET['id'])) { 
    echo "❌ Erreur : Aucun identifiant de billet fourni."; 
    exit(); 
} 
$id = $_GET['id']; 

// Vérifier si le billet existe 
$sql = "SELECT * FROM billet WHERE id = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$id]);
 $billet = $stmt->fetch(); if (!$billet) { 
    echo "❌ Erreur : Billet introuvable."; 
    exit(); } 

// Supprimer le billet 
$sql = "DELETE FROM billet WHERE id = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$id]); 

echo "✅ Billet supprimé avec succès !"; 
header("Location: liste_billets.php"); 
exit(); 
?>