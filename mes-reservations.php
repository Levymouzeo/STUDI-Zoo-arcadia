<?php
session_start();
require_once "config.php"; // Connexion à la BDD

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["visiteur_id"])) {
    echo "Veuillez vous connecter pour voir vos réservations.";
    exit;
}

$visiteur_id = $_SESSION["visiteur_id"];

// Récupérer les billets achetés par le visiteur
$stmt = $pdo->prepare("SELECT id, type, prix, date_achat FROM billet WHERE visiteur_id = :visiteur_id");
$stmt->execute([":visiteur_id" => $visiteur_id]);
$billets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer le total
$total = 0;
foreach ($billets as $billet) {
    $total += $billet["prix"];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="../assets/css/styles2.css">
</head>
<body>

<header>
    <h1>Mes Réservations</h1>
    <a href="Accueil.html">Retour à l'accueil</a>
</header>

<section class="reservations">
    <?php if (empty($billets)) : ?>
        <p>Vous n'avez pas encore acheté de billets.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>Type de billet</th>
                    <th>Prix (€)</th>
                    <th>Date d'achat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($billets as $billet) : ?>
                    <tr>
                        <td><?= htmlspecialchars($billet["type"]) ?></td>
                        <td><?= htmlspecialchars($billet["prix"]) ?> €</td>
                        <td><?= htmlspecialchars($billet["date_achat"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total payé : <?= $total ?> €</h3>
    <?php endif; ?>
</section>

</body>
</html>
