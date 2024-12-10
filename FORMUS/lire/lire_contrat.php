<!-- Usenmez Selim
    2021-05-06
    page php pour la lecture du contrat creer -->

<?php
session_start();
include '../bdd/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../gestion/gestion_contrats.php");
    exit();
}

$contrat_id = (int) $_GET['id'];

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_pwd/login.php");
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM contrats WHERE id = ? AND utilisateur_id = ?');
$stmt->execute([$contrat_id, $_SESSION['user_id']]);
$contrat = $stmt->fetch();

if (!$contrat) {
    echo "Contrat introuvable.";
    exit();
}

$stmtPartenaires = $pdo->prepare('SELECT * FROM partenaires WHERE contrat_id = ?');
$stmtPartenaires->execute([$contrat_id]);
$partenaires = $stmtPartenaires->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lire Contrat</title>
    <link rel="stylesheet" href="../lire/lire_modifier.css">
</head>

<body>

    <div class="container">
        <h1>CONTRAT DE PARTENARIAT COMMERCIAL</h1>

        <p>Ce contrat est fait ce jour <strong><?php echo htmlspecialchars($contrat['date_contrat']); ?></strong>, en copies originales, entre :</p>

        <?php foreach ($partenaires as $key => $partenaire): ?>
            <p>(<?php echo $key + 1; ?>) <strong><?php echo htmlspecialchars($partenaire['nom']); ?></strong></p>
        <?php endforeach; ?>

        <h2>1. NOM DU PARTENARIAT ET ACTIVITE</h2>
        <p><strong>1.1 Nature des activités : </strong><?php echo nl2br(htmlspecialchars($contrat['description'])); ?></p>
        <p><strong>1.2 Nom : </strong><?php echo htmlspecialchars($contrat['nomPartenariat']); ?></p>
        <p><strong>1.3 Adresse officielle : </strong><?php echo htmlspecialchars($contrat['adresse']); ?></p>

        <h2>2. TERMES</h2>
        <p><strong>2.1 Le partenariat commence le : </strong><?php echo htmlspecialchars($contrat['date_contrat']); ?></p>

        <h2>3. CONTRIBUTION AU PARTENARIAT</h2>
        <?php foreach ($partenaires as $key => $partenaire): ?>
            <p>(<?php echo $key + 1; ?>) <strong><?php echo htmlspecialchars($partenaire['nom']); ?> : </strong><?php echo nl2br(htmlspecialchars($partenaire['contribution'])); ?></p>
        <?php endforeach; ?>

        <h2>4. RÉPARTITION DES BÉNÉFICES ET DES PERTES</h2>
        <p><strong>4.1 Les Partenaires se partageront les profits et les pertes du partenariat commercial de la manière suivante :</strong></p>
        <p><?php echo nl2br(htmlspecialchars($contrat['repartition'])); ?></p>

        <h2>5. PARTENAIRES ADDITIONNELS</h2>
        <p>5.1 Aucune personne ne peut être ajoutée en tant que partenaire et aucune autre activité ne peut être menée par le partenariat sans le consentement écrit de tous les partenaires.</p>

        <h2>6. MODALITÉS BANCAIRES ET TERMES FINANCIERS</h2>
        <p><strong>6.1 Les Partenaires doivent avoir un compte bancaire au nom du partenariat sur lequel les chèques doivent être signés par au moins <strong>[Remplir]</strong> des Partenaires.</p>
        <p><strong>6.2 Les Partenaires doivent tenir une comptabilité complète du partenariat et la rendre disponible à tous les Partenaires à tout moment.</p>

        <h2>7. GESTION DES ACTIVITÉS DE PARTENARIAT</h2>
        <p><strong>7.1 Gestion des activités :</strong> <?php echo nl2br(htmlspecialchars($contrat['gestionActivites'])); ?></p>

        <h2>8. DÉPART D'UN PARTENAIRE COMMERCIAL</h2>
        <p><strong>8.1 Départ d'un partenaire :</strong> <?php echo nl2br(htmlspecialchars($contrat['departPartenaire'])); ?></p>

        <h2>9. CLAUSE DE NON CONCURRENCE</h2>
        <p><strong>9.1 Un partenaire qui se retire ne doit pas s'engager dans une entreprise concurrente pendant :</strong> <?php echo htmlspecialchars($contrat['nonConcurrence']); ?></p>

        <h2>10. MODIFICATION DE L’ACCORD DE PARTENARIAT</h2>
        <p>10.1 Ce contrat de partenariat commercial ne peut être modifié sans le consentement écrit de tous les partenaires.</p>

        <h2>11. DIVERS</h2>
        <p>11.1 Si une disposition est non applicable, elle sera dissociée sans affecter la validité du reste de la convention.</p>

        <h2>12. JURIDICTION</h2>
        <p><strong>12.1 Le présent contrat est régi par les lois de : </strong><?php echo htmlspecialchars($contrat['juridiction']); ?></p>

        <a href="../gestion/gestion_contrats.php">Retour</a>

        <script src="../js_outils/script_couleur.js"></script>
    </div>

</body>

</html>