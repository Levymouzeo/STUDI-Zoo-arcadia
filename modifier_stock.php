<?php
include 'config.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    echo "❌ Erreur : Aucun identifiant de stock fourni.";
    exit();
}

$id = $_GET['id'];

// Récupérer les infos du stock
$sql = "SELECT * FROM stock_nourriture WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$stock = $stmt->fetch();

if (!$stock) {
    echo "❌ Erreur : Stock introuvable.";
    exit();
}

// Mettre à jour le stock
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_nourriture = $_POST['type_nourriture'];
    $quantite = $_POST['quantite'];
    $date_reception = $_POST['date_reception'];

    $sql = "UPDATE stock_nourriture SET type_nourriture = ?, quantite = ?, date_reception = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$type_nourriture, $quantite, $date_reception, $id]);

    echo "✅ Stock mis à jour avec succès !";
    header("Location: liste_stock.php");
    exit();
}
?>
<style>
    form {
        margin-top: 20px;
        border: 1px solid #3333;
        padding: 10px;
        width: 300px;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input, select {
        margin-top: 5px;
        width: 100%;
        padding: 5px;
    }

    button {
        margin-top: 10px;
        padding: 5px 10px;
        background-color: #333;
        color: white;
    }
</style>
<!-- Formulaire de modification -->
<h2>Modifier un stock 📝</h2>
<form method="POST">
    <label>Type de nourriture :</label>
    <input type="text" name="type_nourriture" value="<?= htmlspecialchars($stock['type_nourriture']) ?>" required><br>

    <label>Quantité (kg) :</label>
    <input type="number" name="quantite" value="<?= htmlspecialchars($stock['quantite']) ?>" required><br>

    <label>Date de réception :</label>
    <input type="date" name="date_reception" value="<?= htmlspecialchars($stock['date_reception']) ?>" required><br>

    <button type="submit">Modifier</button>
</form>

<a href="liste_stock.php">🔙 Retour à la liste</a>
