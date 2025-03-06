<?php
require_once "config.php"; // Connexion à la base de données

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visiteur_id = $_POST["visiteur_id"];
    $billet_id = $_POST["billet_id"];
    $date_reservation = date("Y-m-d"); 
    $evenement_id = $_POST["evenement_id"];
   
    // Vérification des champs
    if (!filter_var($visiteur_id, FILTER_VALIDATE_INT) || 
        !filter_var($billet_id, FILTER_VALIDATE_INT) || 
        !filter_var($evenement_id, FILTER_VALIDATE_INT)) {
        echo "❌ Erreur : Données invalides.";
        exit();
    }

    // Insertion en base de données
    $stmt = $pdo->prepare("INSERT INTO reservation (visiteur_id, billet_id, date_reservation, evenement_id) 
                           VALUES (:visiteur_id, :billet_id, :date_reservation, :evenement_id)");

    $stmt->execute([
        ":visiteur_id" => $visiteur_id,
        ":billet_id" => $billet_id,
        ":date_reservation" => $date_reservation,
        ":evenement_id" => $evenement_id
    ]);

    if ($stmt) {
        echo "success";
    } else {
        echo "❌ Une erreur est survenue lors de la réservation.";
    }
} else {
    echo "❌ Requête invalide.";
}
?>
