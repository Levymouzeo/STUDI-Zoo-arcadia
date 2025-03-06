<?php
session_start(); // Démarrer la session si elle n'est pas déjà active
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM utilisateur WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();


if (!$user) {
    die("❌ L'email n'existe pas en base !");
}

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Stocker les informations utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_name'] = $user['nom'];

        // Rediriger selon le rôle de l'utilisateur
        if ($user['role'] == 'admin') {
            header("Location: dashboard.php");
            
        } elseif ($user['role'] == 'employe') {
            header("Location: employe_dashboard.php");
        } else {
            header("Location: visiteur_dashboard.php");
        }
        exit();
    } else {
        $error_message = "❌ Email ou mot de passe incorrect.";
    }
}


?>

<style>
    form {
        display: flex;
        flex-direction: column;
        width: 50%;
        margin: 0 auto;
    }
    input {
        margin-top: 5px;
        padding: 5px;
    }
    button {
        margin-top: 10px;
        padding: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    .error {
        color: red;
        text-align: center;
    }
</style>

<?php if (isset($error_message)) : ?>
    <p class="error"><?= $error_message ?></p>
<?php endif; ?>

<form method="POST">
    Email : <input type="email" name="email" required><br>
    Mot de passe : <input type="password" name="password" required><br>
    <button type="submit">Connexion</button>
</form>
