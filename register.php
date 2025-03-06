<?php
include 'config.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Vérifier si l'email est déjà utilisé
    $sql_check = "SELECT id FROM utilisateur WHERE email = :email";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([':email' => $email]);

    if ($stmt_check->fetch()) {
        echo "❌ Cet email est déjà utilisé. Veuillez en choisir un autre.";
        exit();
    }

    // Hacher le mot de passe
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans la base de données
    $sql_insert = "INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (:nom, :email, :password, :role)";
    $stmt_insert = $pdo->prepare($sql_insert);
    
    $inserted = $stmt_insert->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':password' => $password_hashed,
        ':role' => $role
    ]);

    if ($inserted) {
        echo "✅ Inscription réussie ! Vous pouvez maintenant <a href='login.php'>vous connecter</a>.";
    } else {
        echo "❌ Une erreur est survenue lors de l'inscription.";
    }
}
?>
