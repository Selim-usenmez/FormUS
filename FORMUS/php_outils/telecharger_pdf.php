<!-- Usenmez Selim
    2021-05-06
    page php le telechargement en PDF du contrat-->

<?php
session_start();
include '../bdd/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../gestion/gestion_contrats.php");
    exit();
}

$contrat_id = (int) $_GET['id'];

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
    <title>Contrat de Partenariat</title>
    <link rel="stylesheet" href="../styles/contrat_style.css">
</head>

<body>

    <div class="container">
        <h1>Contrat de Partenariat Commercial</h1>

        <button class="print-btn" onclick="window.print()">Télécharger en PDF</button>

        <div class="section">
            <p>Ce contrat est fait ce jour <strong><?php echo htmlspecialchars($contrat['date_contrat']); ?></strong>, en copies originales, entre :</p>
            <?php foreach ($partenaires as $key => $partenaire): ?>
                <p>(<?php echo $key + 1; ?>) <strong><?php echo htmlspecialchars($partenaire['nom']); ?></strong></p>
            <?php endforeach; ?>
        </div>

        <div class="section">
            <h2>1. NOM DU PARTENARIAT ET ACTIVITE</h2>
            <p><strong>1.1 Nature des activités :</strong> <?php echo htmlspecialchars($contrat['description']); ?></p>
            <p><strong>1.2 Nom :</strong> <?php echo htmlspecialchars($contrat['nomPartenariat']); ?></p>
            <p><strong>1.3 Adresse officielle :</strong> <?php echo htmlspecialchars($contrat['adresse']); ?></p>
        </div>

        <div class="section">
            <h2>2. TERMES</h2>
            <p><strong>2.1 Le partenariat commence le :</strong> <?php echo htmlspecialchars($contrat['date_contrat']); ?></p>
        </div>

        <div class="section">
            <h2>3. CONTRIBUTION AU PARTENARIAT</h2>
            <?php foreach ($partenaires as $key => $partenaire): ?>
                <p>(<?php echo $key + 1; ?>) <strong><?php echo htmlspecialchars($partenaire['nom']); ?> :</strong> <?php echo htmlspecialchars($partenaire['contribution']); ?></p>
            <?php endforeach; ?>
        </div>

        <div class="section">
            <h2>4. RÉPARTITION DES BÉNÉFICES ET DES PERTES</h2>
            <p><?php echo htmlspecialchars($contrat['repartition']); ?></p>
        </div>

        <div class="section">
            <h2>5. MODALITÉS BANCAIRES ET TERMES FINANCIERS</h2>
            <p><strong>Modalités bancaires :</strong> <?php echo htmlspecialchars($contrat['modalitesBancaires']); ?></p>
        </div>

        <div class="section">
            <h2>6. JURIDICTION</h2>
            <p><strong>Le présent contrat est régi par les lois de :</strong> <?php echo htmlspecialchars($contrat['juridiction']); ?></p>
        </div>

    </div>

    <script src="../js_outils/script_couleur.js"></script>

</body>



</html>