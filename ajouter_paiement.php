<?php include 'config.php'; 

// Récupérer les billets existants 
$sql = "SELECT * FROM billet"; 
$stmt = $pdo->query($sql); 
$billets = $stmt->fetchAll(); 

// Traitement du formulaire 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $billet_id = $_POST['billet_id']; 
    $montant = $_POST['montant']; 
    $methode = $_POST['methode']; 
    
// Insertion dans la base 
$sql = "INSERT INTO paiement (billet_id, montant, methode) VALUES (?, ?, ?)"; 
$stmt = $pdo->prepare($sql); $stmt->execute([$billet_id, $montant, $methode]); 

echo "✅ Paiement ajouté avec succès !"; 
header("Location: liste_paiements.php"); 
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
    }
</style>

<!-- Formulaire d'ajout de paiement --> 
 <form method="POST">
     <label>Billet :</label> 
     <select name="billet_id" required> 
        <?php foreach ($billets as $b) : ?> 
            <option value="<?= $b['id'] ?>">Billet #<?= $b['id'] ?> - <?= $b['type'] ?> (<?= $b['prix'] ?>€)</option> 
            <?php endforeach; ?> 
        </select><br> 
        
        <label>Montant :</label> 
        <input type="number" name="montant" step="0.01" required><br> 
        
        <label>Méthode de paiement :</label> 
        <select name="methode" required> 
            <option value="Carte Bancaire">Carte Bancaire</option> 
            <option value="Espèces">Espèces</option> 
            <option value="Virement">Virement</option> 
        </select><br> 
            <button type="submit">Ajouter Paiement</button> 
    </form>