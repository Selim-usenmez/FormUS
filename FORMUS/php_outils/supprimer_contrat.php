<!-- Usenmez Selim
    2021-05-06
    page php pour cnotification de suppression de contrat dans la page gestion-->

<?php
session_start();
include '../bdd/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_pwd/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../gestion/gestion_contrats.php");
    exit();
}

$contrat_id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM contrats WHERE id = ? AND utilisateur_id = ?');
if ($stmt->execute([$contrat_id, $_SESSION['user_id']])) {
    $_SESSION['message'] = "Le contrat a été supprimé avec succès!";
    header("Location: ../gestion/gestion_contrats.php");
    exit();
} else {
    $_SESSION['message'] = "Erreur lors de la suppression du contrat.";
    header("Location: ../gestion/gestion_contrats.php");
    exit();
}
?>