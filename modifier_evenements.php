<?php
include 'config.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    echo "❌ Erreur : Aucun identifiant d'événement fourni.";
    exit();
}

$id = $_GET['id'];

// Récupérer les infos de l'événement
$sql = "SELECT * FROM evenements WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$evenement = $stmt->fetch();

if (!$evenement) {
    echo "❌ Erreur : Événement introuvable.";
    exit();
}

// Mettre à jour l'événement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $date_event = $_POST['date_event'];
    $heure = $_POST['heure'];
    $lieu = $_POST['lieu'];

    $sql = "UPDATE evenements SET nom = ?, description = ?, date_event = ?, heure = ?, lieu = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $date_event, $heure, $lieu, $id]);

    echo "✅ Événement mis à jour avec succès !";
    header("Location: liste_evenements.php");
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
    input, textarea {
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
    a {
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        color: #333;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
<h2>Modifier un événement 📝</h2>
<form method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($evenement['nom']) ?>" required><br>

    <label>Description :</label>
    <textarea name="description" required><?= htmlspecialchars($evenement['description']) ?></textarea><br>

    <label>Date :</label>
    <input type="date" name="date_event" value="<?= htmlspecialchars($evenement['date_event']) ?>" required><br>

    <label>Heure :</label>
    <input type="time" name="heure" value="<?= htmlspecialchars($evenement['heure']) ?>" required><br>

    <label>Lieu :</label>
    <input type="text" name="lieu" value="<?= htmlspecialchars($evenement['lieu']) ?>" required><br>

    <button type="submit">Modifier</button>
</form>

<a href="liste_evenements.php">🔙 Retour à la liste</a>
Path : http://localhost/modifier_evenements.php?id=1 ou http://localhost/modifier_evenements.php?id=2 // etc.