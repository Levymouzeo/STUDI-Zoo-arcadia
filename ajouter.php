<?php
// Connexion à PostgreSQL
$host = "localhost";
$dbname = "zoo_arcadia";
$user = "postgres";
$password = "Stadta1jvtc";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT); // Hachage du mot de passe

        // Requête SQL pour insérer un utilisateur
        $sql = "INSERT INTO utilisateur (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "nom" => $nom,
            "email" => $email,
            "mot_de_passe" => $mot_de_passe
        ]);

        // Redirection vers index.php
        header("Location: index2.php");
        exit();
    }
} catch (PDOException $e) {
    die("❌ Erreur : " . $e->getMessage());
}
?>
