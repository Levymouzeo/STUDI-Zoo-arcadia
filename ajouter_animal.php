<?php
include 'config.php'; // Assure-toi que ce fichier contient la connexion à PostgreSQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $race = $_POST['race'];
    $image = $_POST['image'];
    $habitat_id = $_POST['habitat_id'];
    $etat = $_POST['etat'];
    $nourriture = $_POST['nourriture'];
    $grammage = $_POST['grammage'];
    $date_derniere_visite = $_POST['date_derniere_visite'];

    $sql = "INSERT INTO animal (id,nom, race, image,habitat_id, etat, nourriture,grammage,date_derniere_visite) VALUES (?,?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':id' => $id,
        ':nom' => $nom,
        ':race' => $race,
        ':image' => $image,
        ':habitat_id' => $habitat_id,
        ':etat' => $etat,
        ':nourriture' => $nourriture,
        ':grammage' => $grammage,
        ':date_derniere_visite' => $date_derniere_visite
    ]);
 
   echo "✅ Animal ajouté avec succès !";
}
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 30%;
    }
    input {
        margin-bottom: 10px;
        padding: 5px;
    }
    button {
        padding: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
    }
    button:hover {
        cursor: pointer;
    }
</style>
<form method="POST">
    ID : <input type="number" name="id" required><br>
    Nom : <input type="text" name="nom" required><br>
    Race : <input type="text" name="race" required><br>
    Image : <input type="string" name="image" required><br>
    Habitat ID : <input type="number" name="habitat_id" required><br>
    Etat : <input type="text" name="etat" required><br>
    Nourriture : <input type="text" name="nourriture" required><br>
    Grammage : <input type="number" name="grammage" required><br>
    Date de la dernière visite : <input type="date" name="date_derniere_visite" required><br>
    <button type="submit">Ajouter</button>
</form>
