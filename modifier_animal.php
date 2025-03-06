<?php
include 'config.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de l'animal
    $sql = "SELECT * FROM animal WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $animal = $stmt->fetch();

    if (!$animal) {
        echo "❌ Animal non trouvé.";
        exit;
    }
} else{
    echo "❌ Erreur : Aucun identifiant d'animal fourni.";
    exit;
}
// Mettre à jour l'animal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $race = $_POST['race'];
    $image = $_POST['image'];
    $habitat_id = $_POST['habitat_id'];
    $etat = $_POST['etat'];
    $nourriture = $_POST['nourriture'];
    $grammage = $_POST['grammage'];
    $date_derniere_visite = $_POST['date_derniere_visite'];
   
    try {
    $sql = "UPDATE animal SET nom = :nom, race = :race, image = :image, habitat_id = :habitat_id, etat = :etat, nourriture = :nourriture, grammage = :grammage, date_derniere_visite = :date_derniere_visite WHERE id = ?";
    
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
    
    echo "✅ Animal modifié avec succès !";
} catch (PDOException $e) {
       echo "❌ Erreur: " . $e->getMessage();
    }

}
// Formulaire pré-rempli
?>
<style>
    input, select {
        margin: 5px;
    }
</style>
<form method="POST">
    Nom : <input type="text" name="nom" value="<?= $animal['nom'] ?>" required><br>
    Race : <input type="text" name="race" value="<?= $animal['race'] ?>" required><br>
    Image : <input type="text" name="image" value="<?= $animal['image'] ?>" required><br>
    Habitat ID : <input type="number" name="habitat_id" value="<?= $animal['habitat_id'] ?>" required><br>
    Etat : <input type="text" name="etat" value="<?= $animal['etat'] ?>" required><br>
    Nourriture : <input type="text" name="nourriture" value="<?= $animal['nourriture'] ?>" required><br>
    Grammage : <input type="number" name="grammage" value="<?= $animal['grammage'] ?>" required><br>
    Date de la dernière visite : <input type="date" name="date_derniere_visite" value="<?= $animal['date_derniere_visite'] ?>" required><br>
    <button type="submit">Modifier</button>
</form>
