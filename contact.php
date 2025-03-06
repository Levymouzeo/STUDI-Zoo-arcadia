<?php
require_once "config.php"; // Connexion à la base de données

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $sujet = trim($_POST["sujet"]);
    $message = trim($_POST["message"]);

    // Vérification des champs
    if (empty($name) || empty($email) || empty($sujet) || empty($message)) {
        echo "❌ Veuillez remplir tous les champs.";
        exit();
    }

    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "❌ L'adresse email n'est pas valide.";
        exit();
    }

    // Enregistrement en base de données
    try {
        $stmt = $pdo->prepare("INSERT INTO contact ( email,sujet, message) VALUES ( :email,:sujet, :message)");
        $stmt->execute([
            ":email" => $email,
            ":sujet" => $sujet,
            ":message" => $message,
            
        ]);

        // Envoi d'un email de confirmation
        $to = $email;
        $subject = "Confirmation de votre message - Zoo Arcadia";
        $headers = "From: contact@zooarcadia.fr" . "\r\n" .
                   "Reply-To: contact@zooarcadia.fr" . "\r\n" .
                   "Content-Type: text/plain; charset=UTF-8";

        $emailMessage = "Bonjour $name,\n\nMerci pour votre message ! Nous vous répondrons dans les plus brefs délais.\n\nVotre message :\n$message\n\nCordialement,\nL'équipe du Zoo Arcadia";

        mail($to, $subject, $emailMessage, $headers);

        echo "✅ Message envoyé avec succès !";
    } catch (PDOException $e) {
        echo "❌ Erreur lors de l'envoi du message : " . $e->getMessage();
    }
} else {
    echo "❌ Requête invalide.";
}
?>
