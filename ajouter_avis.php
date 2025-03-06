<?php
session_start();
if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit;
}
?>


<?php include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $pseudo = $_POST['pseudo']; 
    $commentaire = $_POST['commentaire']; 
    
    $sql = "INSERT INTO avis (pseudo, commentaire, valide) VALUES (?, ?, false)"; 
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$pseudo, $commentaire]); 
    
    echo "✅ Avis soumis avec succès ! En attente de validation."; 
    header("Location: liste_avis.php"); 
    exit(); 
    } 
?> 
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 50%;
        margin: 0 auto;
    }
    label {
        margin-top: 10px;
    }
    input, textarea {
        margin-top: 5px;
        padding: 5px;
    }
    button {
        margin-top: 10px;
        padding: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
</style>

<form method="POST"> 
    <label>Pseudo :</label> 
    <input type="text" name="pseudo" required><br> 
    
    <label>Commentaire :</label> 
    <textarea name="commentaire" required></textarea><br> 
    
    <button type="submit">Soumettre l'avis</button> 
</form>