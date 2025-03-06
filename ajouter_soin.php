<?php include 'config.php'; 

// Récupérer les employés
$sql = "SELECT id, nom FROM employe"; 
$stmt = $pdo->query($sql); 
$employes = $stmt->fetchAll(); 


// Récupérer les animaux 
$sql = "SELECT id, nom FROM animal"; 
$stmt = $pdo->query($sql); 
$animaux = $stmt->fetchAll(); 


// Traitement du formulaire 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $animal_id = $_POST['animal_id']; 
    $description = $_POST['description']; 
    $date_soin = $_POST['date_soin']; 
    $employe_id = $_POST['employe_id']; 
    
    // Insertion dans la base de données 
    $sql = "INSERT INTO soins (animal_id, description, date_soin, employe_id) VALUES (?, ?, ?, ?)"; 
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$animal_id, $description, $date_soin, $employe_id]); 
    
    echo "✅ Soin ajouté avec succès !"; 
    header("Location: liste_soins.php"); 
    exit(); 
    } 
    ?> 
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 50%;
        }
        label {
            margin-top: 10px;
        }
        select {
            margin-bottom: 10px;
        }
        button {
            margin-top: 10px;
            width: 100px;
            align-self: flex-end;
        }
    </style>
    <h2>Ajouter un soin</h2>
    <!-- Formulaire d'ajout de soin --> 
     <form method="POST"> 
        <label>Animal :</label> 
        <select name="animal_id" required> 
            <?php foreach ($animaux as $a) : ?> 
                <option value="<?= $a['id'] ?>"><?= $a['nom'] ?></option> 
                <?php endforeach; ?> 
            </select><br> 
            
            <label>Description :</label> 
            <input type="text" name="description" required><br> 
            
            <label>Date du soin :</label> 
            <input type="date" name="date_soin" required><br> 
            
            <label>Employé :</label> 
        <select name="employe_id" required> 
            <?php foreach ($employes as $e) : ?> 
                <option value="<?= $e['id'] ?>"><?= $e['nom'] ?></option> 
                <?php endforeach; ?> 
            </select><br> 
            <button type="submit">Ajouter</button> 
        </form>