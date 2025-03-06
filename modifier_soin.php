<?php
include 'config.php';

$id = $_GET['id'] ?? null; // Assigne null si "id" n'existe pas

if (!$id) {
    die("Erreur : ID du soin manquant !");
}


// Récupérer les infos du soin à modifier
$sql = "SELECT * FROM soins WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$soin = $stmt->fetch();

if ($soin) {
    echo "✅ Soin mis à jour avec succès !";
    exit();
}
// Si la modifaication n'est pas possible
if (!$soin) {
    echo "Erreur: echec de mise à jour !";
    exit();
}

// Récupérer les animaux et employés pour la liste déroulante
$animaux = $pdo->query("SELECT id, nom FROM animal")->fetchAll();
$employes = $pdo->query("SELECT id, nom FROM employe")->fetchAll();

// Mettre à jour les données du soin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'];
    $description = $_POST['description'];
    $date_soin = $_POST['date_soin'];
    $employe_id = $_POST['employe_id'];

    $sql = "UPDATE soins SET animal_id = ?,description = ?, date_soin = ?, employe_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$animal_id,$description,$date_soin, $employe_id, $id]);

    echo "✅ Soin mis à jour avec succès !";
    header("Location: liste_soins.php");
    exit();
}
?>

<h2>Modifier un soin</h2>

<form method="POST">
    <label>Animal :</label>
    <select name="animal_id" required>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>" <?= ($a['id'] == $soin['animal_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($a['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Description :</label>
    <input type="text" name="description" value="<?= htmlspecialchars($soin['description']) ?>" required><br>

    <label>Date du soin :</label>
    <input type="date" name="date_soin" value="<?= htmlspecialchars($soin['date_soin']) ?>" required><br>

    <label>Employé :</label>
    <select name="employe_id" required>
        <?php foreach ($employes as $e) : ?>
            <option value="<?= $e['id'] ?>" <?= ($e['id'] == $soin['employe_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>
 <button type="submit">Modifier</button>
    
</form>

<a href="liste_soins.php">Retour à la liste</a>
