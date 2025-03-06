<?php include 'config.php'; 

if (!isset($_GET['id'])) { 
    echo "❌ Erreur : Aucun identifiant de paiement fourni."; 
    exit(); 
} 

$id = $_GET['id']; 

// Récupérer les informations du paiement 
$sql = "SELECT * FROM paiement WHERE id = ?"; 
$stmt = $pdo->prepare($sql); 
$stmt->execute([$id]); 
$paiement = $stmt->fetch(); 

if (!$paiement) { 
    echo "❌ Erreur : Paiement introuvable."; 
    exit(); 
} 
// Récupérer la liste des billets pour les options du formulaire 
$sql = "SELECT id, type FROM billet"; 
$stmt = $pdo->query($sql); 
$billets = $stmt->fetchAll(); 

// Traitement du formulaire de modification 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $billet_id = $_POST['billet_id']; 
    $montant = $_POST['montant']; 
    $methode = $_POST['methode']; 
    $date_paiement = $_POST['date_paiement']; 
    
    $sql = "UPDATE paiement SET billet_id = ?, montant = ?, methode = ?, date_paiement = ? WHERE id = ?"; 
    $stmt = $pdo->prepare($sql); $stmt->execute([$billet_id, $montant, $methode, $date_paiement, $id]); 
    
    echo "✅ Paiement mis à jour avec succès !"; 
    header("Location: liste_paiements.php"); 
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
        select, input {
            margin-top: 5px;
            padding: 5px;
            width: 200px;
        }
        button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
    <h2>Modifier un paiement</h2> 
    <form method="POST"> 
        <label>Billet :</label> 
        <select name="billet_id" required>
            <?php foreach ($billets as $b) : ?> 
                <option value="<?= $b['id'] ?>" <?= ($b['id'] == $paiement['billet_id']) ? 'selected' : '' ?>> 
                    <?= $b['type'] ?> 
                </option> 
                <?php endforeach; ?> 
            </select><br> 
            
            <label>Montant :</label> 
            <input type="number" name="montant" value="<?= $paiement['montant'] ?>" step="0.01" required><br> 
            
            <label>Méthode de paiement :</label> 
            <select name="methode" required> 
                <option value="Carte" <?= ($paiement['methode'] == 'Carte') ? 'selected' : '' ?>>Carte</option> 
                <option value="Espèces" <?= ($paiement['methode'] == 'Espèces') ? 'selected' : '' ?>>Espèces</option> 
                <option value="Virement" <?= ($paiement['methode'] == 'Virement') ? 'selected' : '' ?>>Virement</option> 
            </select><br> 
            
            <label>Date du paiement :</label> 
            <input type="date" name="date_paiement" value="<?= $paiement['date_paiement'] ?>" required><br> 
            
            <button type="submit">Modifier</button> 
        </form> 
        <a href="liste_paiements.php">Retour à la liste</a>
