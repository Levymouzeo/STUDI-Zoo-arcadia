<?php include 'config.php'; 

// Récupérer les visiteurs pour la sélection 
$sql = "SELECT id, nom, prenom FROM visiteur"; 
$stmt = $pdo->query($sql); 
$visiteurs = $stmt->fetchAll(); 
// Traitement du formulaire 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $type = $_POST['type']; 
    $prix = $_POST['prix']; 
    $date_achat = $_POST['date_achat']; 
    $visiteur_id = $_POST['visiteur_id'] ?? null; 
    
    $sql = "INSERT INTO billet (type, prix, date_achat, visiteur_id) VALUES (?, ?, ?, ?)"; 
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$type, $prix, $date_achat, $visiteur_id]); 
    
    echo "✅ Billet ajouté avec succès !"; 
    header("Location: liste_billets.php"); 
    exit(); 
} 
?> 
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
    }
    label {
        margin-top: 10px;
    }
    select, input {
        margin-bottom: 10px;
        padding: 5px;
    }
    button {
        padding: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    button:active {
        background-color: #3e8e41;
    }
</style>
<!-- Formulaire d'ajout de billet --> 
 <form method="POST"> 
    <label>Type de billet :</label> 
    <select name="type" required> 
        <option value="Adulte">Adulte</option> 
        <option value="Enfant">Enfant</option> 
        <option value="Senior">Senior</option> 
    </select><br> 
    
    <label>Prix :</label> 
    <input type="number" step="0.01" name="prix" required><br> 
    
    <label>Date d'achat :</label> 
    <input type="date" name="date_achat" required><br> 
    
    <label>Visiteur :</label> 
    <select name="visiteur_id"> 
        <option value="">Non assigné</option> 
        <?php foreach ($visiteurs as $v) : ?> 
            <option value="<?= $v['id'] ?>"><?= $v['nom'] ?> <?= $v['prenom'] ?></option> 
            <?php endforeach; ?> 
        </select><br> 
        <button type="submit">Ajouter</button> 
    </form>