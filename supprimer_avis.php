<?php include 'config.php'; 

if (!isset($_GET['id'])) { 
    die("❌ Erreur : Aucun identifiant d'avis fourni."); 
} 

$id = $_GET['id']; 
$sql = "DELETE FROM avis WHERE id = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$id]); echo "✅ Avis supprimé avec succès !"; 
header("Location: liste_avis.php"); 
exit(); 
?>