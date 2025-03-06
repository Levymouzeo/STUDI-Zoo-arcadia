<?php include 'config.php'; 
// Vérifier si un ID de billet est fourni 
if (!isset($_GET['id'])) { 
    echo "❌ Erreur : Aucun identifiant de billet fourni."; 
    exit();
 } 
 
 $id = $_GET['id']; // Récupérer les infos du billet 
 $sql = "SELECT * FROM billet WHERE id = ?"; 
 $stmt = $pdo->prepare($sql); 
 $stmt->execute([$id]); $billet = $stmt->fetch(); if (!$billet) { 
    echo "❌ Erreur : Billet introuvable."; exit(); 
    } 
    
// Récupérer les visiteurs pour les options du formulaire 
$sql = "SELECT id, nom, prenom FROM visiteur"; 
$stmt = $pdo->query($sql); 
$visiteurs = $stmt->fetchAll();

// Mise à jour du billet 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $visiteur_id = $_POST['visiteur_id']; 
    $type = $_POST['type']; 
    $prix = $_POST['prix']; 
    $date_achat = $_POST['date_achat']; 
    
    $sql = "UPDATE billet SET visiteur_id = ?, type = ?, prix = ?, date_achat = ? WHERE id = ?"; 
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$visiteur_id, $type, $prix, $date_achat, $id]); 
    
    echo "✅ Billet mis à jour avec succès !"; 
    header("Location: liste_billets.php"); 
    exit(); } 
    ?> 
    <style>
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, select {
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
    <h2>Modifier un Billet 🎟️</h2> 
    
    <form method="POST"> 
        <label>Visiteur :</label> 
        <select name="visiteur_id" required> 
            <?php foreach ($visiteurs as $v) : ?> 
                <option value="<?= $v['id'] ?>" <?= ($v['id'] == $billet['visiteur_id']) ? 'selected' : '' ?>> 
                    <?= $v['nom'] . ' ' . $v['prenom'] ?> 
                </option> 
                <?php endforeach; ?> 
            </select><br> 
            
            <label>Type :</label> 
            <input type="text" name="type" value="<?= $billet['type'] ?>" required><br> 
            
            <label>Prix (€) :</label> 
            <input type="number" name="prix" value="<?= $billet['prix'] ?>" step="0.01" required><br> 
            
            <label>Date d'achat :</label> 
            <input type="date" name="date_achat" value="<?= $billet['date_achat'] ?>" required><br> 
            <button type="submit">Modifier</button> 
        </form> 
       