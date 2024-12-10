<!-- Usenmez Selim
    2021-05-06
    page php pour la barre de recherche -->

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour effectuer cette action.";
    exit();
}

include '../bdd/db.php';

$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';

try {
    if (empty($searchTerm)) {
        $stmt = $pdo->prepare("SELECT * FROM contrats WHERE utilisateur_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM contrats WHERE utilisateur_id = ? AND titre LIKE ?");
        $stmt->execute([$_SESSION['user_id'], "%" . $searchTerm . "%"]);
    }

    $contrats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($contrats)) {
        echo "<tr><td colspan='3'>Aucun contrat trouvé.</td></tr>";
        exit();
    }

    foreach ($contrats as $contrat) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($contrat['titre']) . "</td>";
        echo "<td>" . htmlspecialchars($contrat['date_contrat']) . "</td>";
        echo "<td>";

        echo "<a class='fas fa-eye' href='../lire/lire_contrat.php?id=" . urlencode($contrat['id']) . "'></a> | ";
        echo "<a class='fas fa-edit' href='../modifier/modifier_contrat.php?id=" . urlencode($contrat['id']) . "'></a> | ";
        echo "<a class='fas fa-trash-alt' href='../php_outils/supprimer_contrat.php?id=" . urlencode($contrat['id']) . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce contrat ?\");'></a> | ";

        // Récupération des partenaires associés
        $stmtPartenaires = $pdo->prepare('SELECT nom, contribution FROM partenaires WHERE contrat_id = ?');
        $stmtPartenaires->execute([$contrat['id']]);
        $partenaires = $stmtPartenaires->fetchAll(PDO::FETCH_ASSOC);
        $partenaires_json = json_encode($partenaires, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

        // Bouton de téléchargement PDF
        echo "<button class='pdf-btn fas fa-download' onclick='generatePDF(
            \"" . htmlspecialchars($contrat['titre']) . "\", 
            \"" . htmlspecialchars($contrat['date_contrat']) . "\", 
            \"" . htmlspecialchars($contrat['description']) . "\", 
            \"" . htmlspecialchars($contrat['nomPartenariat']) . "\", 
            \"" . htmlspecialchars($contrat['adresse']) . "\", 
            \"" . htmlspecialchars($contrat['modalitesBancaires']) . "\", 
            \"" . htmlspecialchars($contrat['gestionActivites']) . "\", 
            \"" . htmlspecialchars($contrat['departPartenaire']) . "\", 
            \"" . htmlspecialchars($contrat['nonConcurrence']) . "\", 
            \"" . htmlspecialchars($contrat['modificationAccord']) . "\", 
            \"" . htmlspecialchars($contrat['juridiction']) . "\", 
            $partenaires_json
        )' title='Télécharger'></button> | ";

        // Bouton d'impression
        echo "<button class='print-btn fas fa-print' onclick='printContract(" . $contrat['id'] . ")'></button>";

        echo "</td>";
        echo "</tr>";
    }
} catch (Exception $e) {
    echo "<tr><td colspan='3'>Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>