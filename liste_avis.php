<?php include 'config.php'; 

$sql = "SELECT * FROM avis"; 
$stmt = $pdo->query($sql); 
$avis = $stmt->fetchAll(); 
?> 
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<h2>Liste des Avis</h2> 
<table border="1"> 
    <tr> 
        <th>ID</th> 
        <th>Pseudo</th> 
        <th>Commentaire</th> 
        <th>Valide</th> 
        <th>Actions</th> 
    </tr> 
    <?php foreach ($avis as $a) : ?> 
        <tr> 
            <td><?= $a['id'] ?></td> 
            <td><?= $a['pseudo'] ?></td> 
            <td><?= $a['commentaire'] ?></td> 
            <td><?= $a['valide'] ? 'Oui' : 'Non' ?></td> 
            <td> <a href="modifier_avis.php?id=<?= $a['id'] ?>">Modifier</a> | 
            <a href="supprimer_avis.php?id=<?= $a['id'] ?>" onclick="return confirm('Supprimer cet avis ?')">Supprimer</a> </td> 
        </tr> 
        <?php endforeach; ?> 
</table> 
<a href="ajouter_avis.php">Ajouter un avis</a>