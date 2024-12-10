<!-- Usenmez Selim
    2021-05-06
    page php pour la page de log (connection) + intro netflix -->

<?php
session_start();
include '../bdd/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM Table_utilisateur WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];

        header("Location: ../gestion/gestion_contrats.php");
        exit();
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Styles -->
    <link rel="stylesheet" href="netflix.css">
</head>

<body>
    <!-- Animation Netflix-like -->
    <div id="animation-container" class="animation-container">
        <div class="animation-text">
            <span>F</span><span>O</span><span>R</span><span>M</span>
            <span>U</span><span>L</span><span>A</span><span>I</span>
            <span>R</span><span>E</span>
        </div>
        <video id="netflix-video" muted hidden>
            <source src="../toudoum.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la vidéo HTML5.
        </video>
    </div>

    <!-- Formulaire -->
    <div id="form-container" class="form-container hidden">
        <form action="login.php" method="POST">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

            <button type="submit">Se connecter</button>

            <p>Pas encore inscrit ? <a href="register.php">Créez un compte</a></p>
        </form>
    </div>

    <!-- Script -->
    <script src="netflix.js"></script>
</body>

</html>