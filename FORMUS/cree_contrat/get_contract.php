<!-- 
    Nom : Usenmez 
    Prénom : Selim 
    Date : 2021-05-06 
    Fonctionnalité : Code PHP pour la récupération et l'affichage des contrats 
-->

<?php
// Démarrage de la session pour accéder à l'identifiant utilisateur
session_start();

// Inclusion du fichier de connexion à la base de données
include '../bdd/db.php';

// Vérification de la présence de l'identifiant du contrat dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Contrat non spécifié.";
    exit();
}

// Récupération de l'identifiant du contrat et préparation de la requête pour les détails du contrat
$contrat_id = (int) $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM contrats WHERE id = ? AND utilisateur_id = ?');
$stmt->execute([$contrat_id, $_SESSION['user_id']]);
$contrat = $stmt->fetch();

// Vérification si le contrat existe et appartient à l'utilisateur
if (!$contrat) {
    echo "Contrat introuvable.";
    exit();
}

// Récupération des partenaires associés au contrat
$stmtPartenaires = $pdo->prepare('SELECT * FROM partenaires WHERE contrat_id = ?');
$stmtPartenaires->execute([$contrat_id]);
$partenaires = $stmtPartenaires->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Configuration de l'encodage et inclusion des fichiers CSS pour l'affichage et l'impression -->
    <meta charset="UTF-8">
    <title>Contrat de Partenariat</title>
    <link rel="stylesheet" href="../cree_contrat/contrat_style.css">
    <link rel="stylesheet" href="../impression/impression_style.css" media="print">
</head>

<body>
    <div class="container">
        <!-- Titre principal de la page -->
        <h1>Contrat de Partenariat Commercial</h1>

        <!-- Section pour la date et les partenaires -->
        <div class="section">
            <p>Ce contrat est fait ce jour <strong><?php echo htmlspecialchars($contrat['date_contrat']); ?></strong>, en copies originales, entre :</p>
            <?php foreach ($partenaires as $key => $partenaire): ?>
                <p>(<?php echo $key + 1; ?>) <strong><?php echo htmlspecialchars($partenaire['nom']); ?></strong></p>
            <?php endforeach; ?>
        </div>

        <!-- Section pour les informations générales du partenariat -->
        <div class="section">
            <h2>1. NOM DU PARTENARIAT ET ACTIVITÉ</h2>
            <p><strong>1.1 Nature des activités :</strong> <?php echo htmlspecialchars($contrat['description']); ?></p>
            <p><strong>1.2 Nom :</strong> <?php echo htmlspecialchars($contrat['nomPartenariat']); ?></p>
            <p><strong>1.3 Adresse officielle :</strong> <?php echo htmlspecialchars($contrat['adresse']); ?></p>
        </div>

        <!-- Section pour les termes du contrat -->
        <div class="section">
            <h2>2. TERMES</h2>
            <p><strong>2.1 Le partenariat commence le :</strong> <?php echo htmlspecialchars($contrat['date_contrat']); ?></p>
        </div>

        <!-- Section pour les contributions des partenaires -->
        <div class="section">
            <h2>3. CONTRIBUTION AU PARTENARIAT</h2>
            <?php foreach ($partenaires as $key => $partenaire): ?>
                <p>(<?php echo $key + 1; ?>) <strong><?php echo htmlspecialchars($partenaire['nom']); ?> :</strong> <?php echo htmlspecialchars($partenaire['contribution']); ?></p>
            <?php endforeach; ?>
        </div>

        <!-- Section pour la répartition des bénéfices et pertes -->
        <div class="section">
            <h2>4. RÉPARTITION DES BÉNÉFICES ET DES PERTES</h2>
            <p><?php echo htmlspecialchars($contrat['repartition']); ?></p>
        </div>

        <!-- Section pour les modalités bancaires et financières -->
        <div class="section">
            <h2>5. MODALITÉS BANCAIRES ET TERMES FINANCIERS</h2>
            <p><strong>Modalités bancaires :</strong> <?php echo htmlspecialchars($contrat['modalitesBancaires']); ?></p>
        </div>

        <!-- Section pour la juridiction régissant le contrat -->
        <div class="section">
            <h2>6. JURIDICTION</h2>
            <p><strong>Le présent contrat est régi par les lois de :</strong> <?php echo htmlspecialchars($contrat['juridiction']); ?></p>
        </div>
    </div>
</body>

</html>