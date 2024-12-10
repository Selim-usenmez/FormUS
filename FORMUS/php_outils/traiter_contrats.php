<!-- Usenmez Selim
    2021-05-06
    page php pour le traitement des données et faire la liaaison des information de la base donnée a la page -->

<?php
session_start();
include '../bdd/db.php';

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
    $utilisateur_id = $_SESSION['user_id'];

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare('INSERT INTO contrats (titre, date_contrat, description, repartition, nomPartenariat, adresse, modalitesBancaires, gestionActivites, departPartenaire, nonConcurrence, modificationAccord, juridiction, utilisateur_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$titre, $date_contrat, $description, $repartition, $nomPartenariat, $adresse, $modalitesBancaires, $gestionActivites, $departPartenaire, $nonConcurrence, $modificationAccord, $juridiction, $utilisateur_id]);

        $contrat_id = $pdo->lastInsertId();

        $partenaireCount = 1;
        while (isset($_POST["partenaire$partenaireCount"])) {
            $partenaireNom = $_POST["partenaire$partenaireCount"];
            $contribution = $_POST["contribution$partenaireCount"];

            $stmtPartenaire = $pdo->prepare('INSERT INTO partenaires (contrat_id, nom, contribution) VALUES (?, ?, ?)');
            $stmtPartenaire->execute([$contrat_id, $partenaireNom, $contribution]);

            $partenaireCount++;
        }

        $pdo->commit();

        $_SESSION['message'] = "Le contrat a été créé avec succès !";
        header("Location: ../gestion/gestion_contrats.php");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erreur lors de la création du contrat : " . $e->getMessage();
    }
}
