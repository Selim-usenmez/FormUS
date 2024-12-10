<!-- 
    Nom : Usenmez 
    Prénom : Selim 
    Date : 2021-05-06 
    Fonctionnalité : Code PHP pour la page de création du contrat 
-->

<?php
// Démarrage de la session pour gérer l'utilisateur connecté
session_start();

// Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_pwd/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Configuration de l'encodage et du viewport pour un affichage responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un contrat</title>

    <!-- Inclusion des fichiers CSS pour le style de la page -->
    <link rel="stylesheet" href="../cree_contrat/creer_contrat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Bouton pour revenir à la page de gestion des contrats -->
    <div class="btn-retour"> <a href="../gestion/gestion_contrats.php">Retour</a> </div>

    <div class="form-container">
        <!-- Titre de la page -->
        <h1>Créer un contrat de partenariat commercial</h1>

        <!-- Formulaire pour la création d'un contrat -->
        <form action="../php_outils/traiter_contrats.php" method="POST">
            <!-- Champ pour le titre du contrat -->
            <div class="form-group">
                <label for="titre" onmouseover="showPopup('titre')" onmouseout="hidePopup()">Titre du contrat :</label>
                <input type="text" id="titre" name="titre" placeholder="Entrez le titre du contrat" required>
            </div>

            <!-- Champ pour la date du contrat -->
            <div class="form-group">
                <label for="date_contrat" onmouseover="showPopup('date_contrat')" onmouseout="hidePopup()">Date du contrat :</label>
                <input type="date" id="date_contrat" name="date_contrat" required>
            </div>

            <!-- Champ pour la description du contrat -->
            <div class="form-group">
                <label for="description" onmouseover="showPopup('description')" onmouseout="hidePopup()">Description :</label>
                <textarea id="description" name="description" placeholder="Entrez la description du contrat" required></textarea>
            </div>

            <!-- Conteneur dynamique pour les partenaires -->
            <div id="partenaires-container">
            </div>

            <!-- Boutons pour ajouter ou supprimer des partenaires -->
            <div class="button-group">
                <button class="fas fa-plus-circle" type="button" id="ajouter-partenaire" onclick="ajouterPartenaire()">ajouterPartenaire</button>
                <button class="fas fa-trash-alt" type="button" id="supprimer-partenaire" onclick="supprimerPartenaire()"></button>
            </div>

            <!-- Champ pour la répartition des bénéfices et pertes -->
            <div class="form-group">
                <label for="repartition" onmouseover="showPopup('repartition')" onmouseout="hidePopup()">Répartition des bénéfices et des pertes :</label>
                <textarea id="repartition" name="repartition" placeholder="Décrivez la répartition des bénéfices et pertes" required></textarea>
            </div>

            <!-- Champ pour le nom du partenariat -->
            <div class="form-group">
                <label for="nomPartenariat" onmouseover="showPopup('nomPartenariat')" onmouseout="hidePopup()">Nom du partenariat :</label>
                <input type="text" id="nomPartenariat" name="nomPartenariat" placeholder="Nom du partenariat" required>
            </div>

            <!-- Champ pour l'adresse officielle -->
            <div class="form-group">
                <label for="adresse" onmouseover="showPopup('adresse')" onmouseout="hidePopup()">Adresse officielle :</label>
                <input type="text" id="adresse" name="adresse" placeholder="Adresse officielle du partenariat" required>
            </div>

            <!-- Champ pour les modalités bancaires -->
            <div class="form-group">
                <label for="modalitesBancaires" onmouseover="showPopup('modalitesBancaires')" onmouseout="hidePopup()">Modalités bancaires :</label>
                <input type="text" id="modalitesBancaires" name="modalitesBancaires" placeholder="Modalités bancaires et financières">
            </div>

            <!-- Champ pour la gestion des activités -->
            <div class="form-group">
                <label for="gestionActivites" onmouseover="showPopup('gestionActivites')" onmouseout="hidePopup()">Gestion des activités de partenariat :</label>
                <textarea id="gestionActivites" name="gestionActivites" placeholder="Détails de la gestion des activités"></textarea>
            </div>

            <!-- Champ pour les conditions de départ d'un partenaire -->
            <div class="form-group">
                <label for="departPartenaire" onmouseover="showPopup('departPartenaire')" onmouseout="hidePopup()">Départ d'un partenaire :</label>
                <textarea id="departPartenaire" name="departPartenaire" placeholder="Conditions du départ d'un partenaire"></textarea>
            </div>

            <!-- Champ pour la clause de non-concurrence -->
            <div class="form-group">
                <label for="nonConcurrence" onmouseover="showPopup('nonConcurrence')" onmouseout="hidePopup()">Clause de non-concurrence :</label>
                <input type="text" id="nonConcurrence" name="nonConcurrence" placeholder="Durée de la clause de non-concurrence" required>
            </div>

            <!-- Champ pour les conditions de modification de l'accord -->
            <div class="form-group">
                <label for="modificationAccord" onmouseover="showPopup('modificationAccord')" onmouseout="hidePopup()">Modification de l'accord :</label>
                <input type="text" id="modificationAccord" name="modificationAccord" placeholder="Conditions de modification de l'accord" required>
            </div>

            <!-- Champ pour la juridiction -->
            <div class="form-group">
                <label for="juridiction" onmouseover="showPopup('juridiction')" onmouseout="hidePopup()">Juridiction :</label>
                <input type="text" id="juridiction" name="juridiction" placeholder="Région de juridiction" required>
            </div>

            <!-- Bouton pour soumettre le formulaire de création -->
            <button id="creer-contrat" class="disabled">Créer le contrat</button>
        </form>
    </div>

    <!-- Info-bulle pour les explications contextuelles -->
    <div id="popup" class="popup hidden">
        <div class="popup-content">
            <span class="close" onclick="hidePopup()">&times;</span>
            <p id="popup-text"></p>
        </div>
    </div>

    <!-- Chatbot pour l'assistance dans la création du contrat -->
    <div id="chatbox">
        <div id="chatbox-header">
            <i class="fas fa-robot"></i> Chatbot
        </div>
        <div id="messages"></div>
        <input type="text" id="userInput" placeholder="Tapez votre message" />
        <button onclick="sendMessage()">Envoyer</button>
    </div>

    <!-- Inclusion des scripts JavaScript pour le formulaire et le chatbot -->
    <script src="../cree_contrat/creer_contrat.js"></script>
    <script src="../js_outils/partenaires.js"></script>
    <script src="../cree_contrat/creer_form.js"></script>
    <script src="../chatbot/chatbot_form.js"></script>
    <script src="../js_outils/script_couleur.js"></script>

</body>

</html>