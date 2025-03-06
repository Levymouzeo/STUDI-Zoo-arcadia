<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_POST['image'];
 

    $sql = "INSERT INTO habitat (id,nom, description, image) VALUES (:id,:nom, :description, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':nom' => $nom,
        ':description' => $description,
        ':image' => $image
    ]);

    echo "✅ Habitat ajouté avec succès !";
}

?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
    }

    input {
        margin-bottom: 10px;
    }
</style>
<form method="POST">
    ID : <input type="number" name="id" required><br>
    Nom : <input type="text" name="nom" required><br>
    Description : <input type="text" name="description" required><br>
    Image : <input type="string" name="image" required><br>
    <button type="submit">Ajouter</button>
</form>


