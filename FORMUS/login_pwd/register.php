<!-- Usenmez Selim
    2021-05-06
    page php pour création de compte -->

<?php
include '../bdd/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit();
    }

    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('SELECT * FROM Table_utilisateur WHERE email = ?');
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        $stmt = $pdo->prepare('INSERT INTO Table_utilisateur (nom, prenom, email, password) VALUES (?, ?, ?, ?)');
        if ($stmt->execute([$nom, $prenom, $email, $password_hashed])) {
            header("Location: ../login_pwd/login.php");
            exit();
        } else {
            echo "Une erreur est survenue lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="form-container">
        <h1>Inscription</h1>
        <form action="register.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

            <label for="confirm_password">Confirmez le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmez votre mot de passe" required>

            <!-- Checkbox pour afficher/masquer les mots de passe -->
            <input type="checkbox" id="show_password">
            <label for="show_password">Afficher les mots de passe</label>

            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
    </div>

    <script src="../js_outils/passwordVisibility.js"></script>
</body>

</html>