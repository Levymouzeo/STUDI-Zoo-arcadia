<?php include 'config.php'; 

if (!isset($_GET['id'])) { 
    die("❌ Erreur : Aucun identifiant d'avis fourni."); 
} 

$id = $_GET['id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $commentaire = $_POST['commentaire']; 
    $validé = isset($_POST['valide']) ? true : false; 
    
    $sql = "UPDATE avis SET commentaire = ?, valide = ? WHERE id = ?"; 
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$commentaire, $validé, $id]); 
    
    echo "✅ Avis mis à jour avec succès !"; 
    header("Location: liste_avis.php"); 
    exit(); 
} 
$sql = "SELECT * FROM avis WHERE id = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$id]); 
$avis = $stmt->fetch(); 
?> 
<style>
    textarea {
        width: 100%;
        height: 100px;
    }
</style>
<form method="POST"> 
    <label>Commentaire :</label> 
    <textarea name="commentaire" required><?= $avis['commentaire'] ?></textarea><br> 
    
    <label>Valide :</label> 
    <input type="checkbox" name="valide" <?= $avis['valide'] ? 'checked' : '' ?>><br> 
    
    <button type="submit">Modifier</button> 
</form>