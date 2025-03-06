<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM habitat WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $enclos = $stmt->fetch();

    if (!$enclos) {
        echo "❌ Habitat non trouvé.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_POST['image'];
   

    $sql = "UPDATE habitat SET  id = :id, nom = :nom, description = :description, image = :image WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':nom' => $nom,
        ':description' => $description,
        ':image' => $image
    ]);

    echo "✅ Habitat modifié avec succès !";
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
<form method="POST">
    ID : <input type="number" name="id" value="<?= $enclos['id'] ?>" required><br>
    Nom : <input type="text" name="nom" value="<?= $enclos['nom'] ?>" required><br>
    Description : <input type="text" name="description" value="<?= $enclos['description'] ?>" required><br>
    Image : <input type="string" name="image" value="<?= $enclos['image'] ?>" required><br>
    <button type="submit">Modifier</button>
</form>
