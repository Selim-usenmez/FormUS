<!-- Usenmez Selim
    2021-05-06
    page php pour la modification des informations rentrées dans la page créer -->

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $date_contrat = $_POST['date_contrat'];
    $description = $_POST['description'];
    $repartition = $_POST['repartition'];
    $nomPartenariat = $_POST['nomPartenariat'];
    $adresse = $_POST['adresse'];
    $modalitesBancaires = $_POST['modalitesBancaires'];
    $gestionActivites = $_POST['gestionActivites'];
    $departPartenaire = $_POST['departPartenaire'];
    $nonConcurrence = $_POST['nonConcurrence'];
    $modificationAccord = $_POST['modificationAccord'];
    $juridiction = $_POST['juridiction'];

    $stmt = $pdo->prepare('UPDATE contrats SET titre = ?, date_contrat = ?, description = ?, repartition = ?, nomPartenariat = ?, adresse = ?, modalitesBancaires = ?, gestionActivites = ?, departPartenaire = ?, nonConcurrence = ?, modificationAccord = ?, juridiction = ? WHERE id = ? AND utilisateur_id = ?');
    if ($stmt->execute([$titre, $date_contrat, $description, $repartition, $nomPartenariat, $adresse, $modalitesBancaires, $gestionActivites, $departPartenaire, $nonConcurrence, $modificationAccord, $juridiction, $contrat_id, $_SESSION['user_id']])) {

        if (!empty($_POST['supprimer_partenaires'])) {
            foreach ($_POST['supprimer_partenaires'] as $partenaire_id) {
                $stmtSupprimer = $pdo->prepare('DELETE FROM partenaires WHERE id = ? AND contrat_id = ?');
                $stmtSupprimer->execute([$partenaire_id, $contrat_id]);
            }
        }

        foreach ($_POST['partenaires'] as $index => $partenaireData) {
            $partenaire_id = (int) $partenaireData['id'];
            $nomPartenaire = $partenaireData['nom'];
            $contribution = $partenaireData['contribution'];

            $stmtPartenaire = $pdo->prepare('UPDATE partenaires SET nom = ?, contribution = ? WHERE id = ? AND contrat_id = ?');
            $stmtPartenaire->execute([$nomPartenaire, $contribution, $partenaire_id, $contrat_id]);
        }

        if (!empty($_POST['nouveaux_partenaires'])) {
            foreach ($_POST['nouveaux_partenaires'] as $nouveauPartenaire) {
                if (!empty($nouveauPartenaire['nom']) && !empty($nouveauPartenaire['contribution'])) {
                    $stmtNewPartenaire = $pdo->prepare('INSERT INTO partenaires (contrat_id, nom, contribution) VALUES (?, ?, ?)');
                    $stmtNewPartenaire->execute([$contrat_id, $nouveauPartenaire['nom'], $nouveauPartenaire['contribution']]);
                }
            }
        }

        $_SESSION['message'] = "Le contrat et les partenaires ont été mis à jour avec succès!";
        header("Location: ../gestion/gestion_contrats.php");
        exit();
    } else {
        $_SESSION['message'] = "Erreur lors de la mise à jour du contrat.";
        header("Location: ../gestion/gestion_contrats.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Contrat</title>
    <link rel="stylesheet" href="../lire/lire_modifier.css">
</head>

<body>

    <div class="form-container">
        <h1>Modifier le contrat de partenariat</h1>
        <form action="" method="POST">

            <div class="form-group">
                <label for="titre">Titre du contrat :</label>
                <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($contrat['titre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="date_contrat">Date du contrat :</label>
                <input type="date" id="date_contrat" name="date_contrat" value="<?php echo htmlspecialchars($contrat['date_contrat']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($contrat['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="repartition">Répartition des bénéfices et pertes :</label>
                <textarea id="repartition" name="repartition" required><?php echo htmlspecialchars($contrat['repartition']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="nomPartenariat">Nom du partenariat :</label>
                <input type="text" id="nomPartenariat" name="nomPartenariat" value="<?php echo htmlspecialchars($contrat['nomPartenariat']); ?>" required>
            </div>

            <div class="form-group">
                <label for="adresse">Adresse officielle :</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($contrat['adresse']); ?>" required>
            </div>

            <div class="form-group">
                <label for="modalitesBancaires">Modalités bancaires :</label>
                <input type="text" id="modalitesBancaires" name="modalitesBancaires" value="<?php echo htmlspecialchars($contrat['modalitesBancaires']); ?>">
            </div>

            <div class="form-group">
                <label for="gestionActivites">Gestion des activités :</label>
                <textarea id="gestionActivites" name="gestionActivites"><?php echo htmlspecialchars($contrat['gestionActivites']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="departPartenaire">Départ d'un partenaire :</label>
                <textarea id="departPartenaire" name="departPartenaire"><?php echo htmlspecialchars($contrat['departPartenaire']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="nonConcurrence">Clause de non-concurrence :</label>
                <input type="text" id="nonConcurrence" name="nonConcurrence" value="<?php echo htmlspecialchars($contrat['nonConcurrence']); ?>" required>
            </div>

            <div class="form-group">
                <label for="modificationAccord">Modification de l'accord :</label>
                <input type="text" id="modificationAccord" name="modificationAccord" value="<?php echo htmlspecialchars($contrat['modificationAccord']); ?>" required>
            </div>

            <div class="form-group">
                <label for="juridiction">Juridiction :</label>
                <input type="text" id="juridiction" name="juridiction" value="<?php echo htmlspecialchars($contrat['juridiction']); ?>" required>
            </div>

            <h2>Partenaires</h2>
            <?php foreach ($partenaires as $partenaire): ?>
                <div class="form-group partenaire-group" data-partenaire-id="<?php echo $partenaire['id']; ?>">
                    <label for="partenaire_nom_<?php echo $partenaire['id']; ?>">Nom du partenaire :</label>
                    <input type="hidden" name="partenaires[<?php echo $partenaire['id']; ?>][id]" value="<?php echo $partenaire['id']; ?>">
                    <input type="text" id="partenaire_nom_<?php echo $partenaire['id']; ?>" name="partenaires[<?php echo $partenaire['id']; ?>][nom]" value="<?php echo htmlspecialchars($partenaire['nom']); ?>" required>

                    <label for="partenaire_contribution_<?php echo $partenaire['id']; ?>">Contribution :</label>
                    <textarea id="partenaire_contribution_<?php echo $partenaire['id']; ?>" name="partenaires[<?php echo $partenaire['id']; ?>][contribution]" required><?php echo htmlspecialchars($partenaire['contribution']); ?></textarea>

                    <button type="button" class="supprimerPartenaireBtn" data-partenaire-id="<?php echo $partenaire['id']; ?>">Supprimer</button>
                </div>
            <?php endforeach; ?>

            <div id="nouveaux_partenaires_container"></div>
            <button type="button" id="ajouterPartenaire">Ajouter un partenaire</button>

            <button type="submit">Mettre à jour le contrat</button>

            <input type="hidden" id="supprimer_partenaires" name="supprimer_partenaires[]">
        </form>
    </div>


    <script src="../js_outils/script_couleur.js"></script>
    <script src="modifier.js"></script>

</body>

</html>