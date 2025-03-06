<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $prix = $_POST['prix'];
    $date_achat = $_POST['date_achat'];
    $methode = $_POST['methode'];

    // Insérer d'abord le billet
    $sqlBillet = "INSERT INTO billet (type, prix, date_achat) VALUES (?, ?, ?)";
    $stmtBillet = $pdo->prepare($sqlBillet);
    $stmtBillet->execute([$type, $prix, $date_achat]);
    $billet_id = $pdo->lastInsertId();

    // Ensuite, insérer le paiement lié au billet
    $sqlPaiement = "INSERT INTO paiement (billet_id, montant, methode, date_paiement) VALUES (?, ?, ?, ?)";
    $stmtPaiement = $pdo->prepare($sqlPaiement);
    $stmtPaiement->execute([$billet_id, $prix, $methode, $date_achat]);

    echo "✅ Paiement enregistré avec succès !";
} else {
    echo "❌ Erreur : requête invalide.";
}
?>