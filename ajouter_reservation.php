<?php include 'config.php'; 

// Récupérer la liste des visiteurs 
$sql = "SELECT id, nom, prenom FROM visiteur"; 
$stmt = $pdo->query($sql); 
$visiteurs = $stmt->fetchAll(); 

// Récupérer la liste des billets disponibles 
$sql = "SELECT id, type, prix FROM billet"; 
$stmt = $pdo->query($sql); 
$billets = $stmt->fetchAll(); 

// Traitement du formulaire 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $visiteur_id = $_POST['visiteur_id']; 
    $billet_id = $_POST['billet_id']; 
    $date_reservation = $_POST['date_reservation']; 
    
   // Insertion dans la base de données 
    $sql = "INSERT INTO reservation (visiteur_id, billet_id, date_reservation) VALUES (?, ?, ?)"; 
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$visiteur_id, $billet_id, $date_reservation]); 
    
    echo "✅ Réservation ajoutée avec succès !"; 
    header("Location: liste_reservations.php");
     exit(); 
} 
?> 

<style>
    form {
        margin-top: 20px;
    }
    label {
        display: block;
        margin-top: 10px;
    }
    select {
        width: 200px;
        padding: 5px;
    }
    input[type="date"] {
        width: 200px;
        padding: 5px;
    }
    button {
        margin-top: 10px;
        padding: 5px 10px;
    }
</style>

<!-- Formulaire d'ajout de réservation --> 
 <form method="POST"> 
    <label>Visiteur :</label> 
    <select name="visiteur_id" required> 
        <?php foreach ($visiteurs as $v) : ?> 
            <option value="<?= $v['id'] ?>"><?= $v['nom'] ?> <?= $v['prenom'] ?></option> 
            <?php endforeach; ?> 
        </select><br> 
        
        <label>Type de billet :</label> 
        <select name="billet_id" required> 
            <?php foreach ($billets as $b) : ?> 
                <option value="<?= $b['id'] ?>"><?= $b['type'] ?> (<?= $b['prix'] ?> €)</option> 
                <?php endforeach; ?> 
            </select><br> 
            
        <label>Date de réservation :</label> 
        <input type="date" name="date_reservation" required><br> 
        
        <button type="submit">Ajouter</button> 
    </form>