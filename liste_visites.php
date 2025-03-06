<?php
include 'config.php';

// Récupérer les animaux
$sql = "SELECT * FROM animal";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();

// Récupérer les vétérinaires
$sql = "SELECT * FROM veterinaire"; 
$stmt = $pdo->query($sql);
$veterinaires = $stmt->fetchAll();

// Initialiser les filtres
$animal_id = $_GET['animal_id'] ?? '';
$veterinaire_id = $_GET['veterinaire_id'] ?? '';
$date_visite = $_GET['date_visite'] ?? '';

// Construire la requête SQL avec les filtres
$sql = "SELECT v.id, a.nom AS animal, e.nom AS veterinaire, v.date_visite, v.observations 
        FROM visite_medicale v
        JOIN animal a ON v.animal_id = a.id
        LEFT JOIN veterinaire e ON v.veterinaire_id = e.id
        WHERE 1=1";

$params = [];

if (!empty($animal_id)) {
    $sql .= " AND v.animal_id = ?";
    $params[] = $animal_id;
}

if (!empty($veterinaire_id)) {
    $sql .= " AND v.veterinaire_id = ?";
    $params[] = $veterinaire_id;
}

if (!empty($date_visite)) {
    $sql .= " AND v.date_visite = ?";
    $params[] = $date_visite;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$visites = $stmt->fetchAll();
?>

<!-- Formulaire de filtre -->
 <style>
    select {
        width: 200px;
        padding: 5px;
        margin: 5px 0;
    }

    button {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
 </style>
 
<h2>Liste des visites médicales</h2>
<form method="GET">
    <label>Filtrer par animal :</label>
    <select name="animal_id">
        <option value="">Tous</option>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>" <?= ($a['id'] == $animal_id) ? 'selected' : '' ?>>
                <?= $a['nom'] ?> (<?= $a['race'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label>Filtrer par vétérinaire :</label>
    <select name="veterinaire_id">
        <option value="">Tous</option>
        <?php foreach ($veterinaires as $v) : ?>
            <option value="<?= $v['id'] ?>" <?= ($v['id'] == $veterinaire_id) ? 'selected' : '' ?>>
                <?= $v['nom'] ?> <?= $v['prenom'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Filtrer par date :</label>
    <input type="date" name="date_visite" value="<?= $date_visite ?>">

    <button type="submit">Appliquer</button>
</form>

<!-- Table des visites médicales -->
<table border="1">
    <tr>
        <th>Animal</th>
        <th>Vétérinaire</th>
        <th>Date</th>
        <th>Observations</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($visites as $v) : ?>
        <tr>
            <td><?= $v['animal'] ?></td>
            <td><?= $v['veterinaire'] ?: 'Non assigné' ?></td>
            <td><?= $v['date_visite'] ?></td>
            <td><?= $v['observations'] ?></td>
            <td>
                <a href="modifier_visite.php?id=<?= $v['id'] ?>">Modifier</a> |
                <a href="supprimer_visite.php?id=<?= $v['id'] ?>" onclick="return confirm('Supprimer cette visite ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
