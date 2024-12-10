<!-- 
    Nom : Usenmez 
    Prénom : Selim 
    Date : 2021-05-06 
    Fonctionnalité : Code PHP pour la gestion des contrats 
-->

<?php
// Démarrage de la session pour gérer l'utilisateur connecté
session_start();

// Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_pwd/login.php");
    exit();
}

// Inclusion du fichier de connexion à la base de données
include '../bdd/db.php';

// Requête pour récupérer tous les contrats associés à l'utilisateur connecté
$stmt = $pdo->prepare('SELECT * FROM contrats WHERE utilisateur_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$contrats = $stmt->fetchAll();

// Gestion des notifications temporaires (flash message)
$notification = "";
if (isset($_SESSION['message'])) {
    $notification = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Configuration de l'encodage, du viewport, et inclusion des fichiers CSS et JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Contrats</title>
    <link rel="stylesheet" href="../gestion/gestion_contrats.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="../js_outils/pdf_generator.js"></script>
    <script src="../impression/impression.js"></script>
</head>

<body>
    <!-- Bouton pour changer la couleur du thème -->
    <button id="change-color-btn">
        <i class="fas fa-palette"></i>
    </button>
    <script src="../js_outils/script_couleur.js"></script>

    <!-- Affichage de la notification si elle existe -->
    <?php if (!empty($notification)) : ?>
        <div id="notification" class="notification">
            <?php echo htmlspecialchars($notification); ?>
        </div>
    <?php endif; ?>

    <!-- Message de bienvenue à l'utilisateur -->
    <h1 class="welcome-text">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_prenom']); ?></h1>

    <!-- Option pour ajouter un logo -->
    <div id="checkbox-container">
        <label for="add-logo-checkbox">Voulez-vous ajouter un logo ?</label>
        <input type="checkbox" id="add-logo-checkbox" onclick="toggleLogoOptions()">
    </div>

    <!-- Options pour ajouter un logo avec sa position -->
    <div class="btn-ajouter" id="logo-options" style="display: none;">
        <label for="logo-input">Choisissez un logo à ajouter :</label>
        <input type="file" id="logo-input" accept="image/*">
        <br>
        <label for="logo-position">Sélectionnez l'emplacement du logo :</label>
        <select id="logo-position">
            <option value="top-left">Haut gauche</option>
            <option value="top-right">Haut droit</option>
            <option value="bottom-left">Bas gauche</option>
            <option value="bottom-right">Bas droit</option>
        </select>
    </div>

    <!-- Barre de recherche pour filtrer les contrats -->
    <input type="text" id="searchBar" placeholder="Rechercher un contrat..." onkeyup="searchContract()">

    <h2>Voici vos contrats :</h2>

    <!-- Tableau listant les contrats de l'utilisateur -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-file-alt"></i> Titre du Contrat</th>
                    <th><i class="fas fa-calendar-alt"></i> Date du Contrat</th>
                    <th><i class="fas fa-tools"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contrats as $contrat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contrat['titre']); ?></td>
                        <td><?php echo htmlspecialchars($contrat['date_contrat']); ?></td>
                        <td>
                            <!-- Boutons pour lire, modifier, supprimer, télécharger en PDF, ou imprimer un contrat -->
                            <a class="fas fa-eye" href="../lire/lire_contrat.php?id=<?php echo $contrat['id']; ?>" title="Lire"></a> |
                            <a class="fas fa-edit" href="../modifier/modifier_contrat.php?id=<?php echo $contrat['id']; ?>" title="Modifier"></a> |
                            <a class="fas fa-trash-alt" href="../php_outils/supprimer_contrat.php?id=<?php echo $contrat['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?');" title="Supprimer"></a> |

                            <?php
                            // Requête pour récupérer les partenaires associés à chaque contrat
                            $stmtPartenaires = $pdo->prepare('SELECT nom, contribution FROM partenaires WHERE contrat_id = ?');
                            $stmtPartenaires->execute([$contrat['id']]);
                            $partenaires = $stmtPartenaires->fetchAll(PDO::FETCH_ASSOC);
                            $partenaires_json = json_encode($partenaires, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
                            ?>

                            <!-- Boutons pour générer un PDF ou imprimer le contrat -->
                            <button class="pdf-btn fas fa-download" onclick='generatePDF(
                                "<?php echo htmlspecialchars($contrat['titre']); ?>", 
                                "<?php echo htmlspecialchars($contrat['date_contrat']); ?>", 
                                "<?php echo htmlspecialchars($contrat['description']); ?>", 
                                "<?php echo htmlspecialchars($contrat['nomPartenariat']); ?>", 
                                "<?php echo htmlspecialchars($contrat['adresse']); ?>", 
                                "<?php echo htmlspecialchars($contrat['modalitesBancaires']); ?>", 
                                "<?php echo htmlspecialchars($contrat['gestionActivites']); ?>", 
                                "<?php echo htmlspecialchars($contrat['departPartenaire']); ?>", 
                                "<?php echo htmlspecialchars($contrat['nonConcurrence']); ?>", 
                                "<?php echo htmlspecialchars($contrat['modificationAccord']); ?>", 
                                "<?php echo htmlspecialchars($contrat['juridiction']); ?>", 
                                <?php echo $partenaires_json; ?>
                            )' title="Télécharger"></button>
                            <button class='print-btn fas fa-print' onclick='printContract(<?php echo $contrat['id']; ?>)'></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bouton pour créer un nouveau contrat -->
    <div class="btn-right">
        <a href="../cree_contrat/creer_contrat.php" class="btn">
            <i class="fas fa-folder-plus"></i> Créer un contrat
        </a>
    </div>

    <!-- Conteneur pour le formulaire de création, caché par défaut -->
    <div class="form-container hidden">
        <form id="creer-contrat-form" action="../php_outils/traiter_contrats.php" method="POST">
            <input type="hidden" id="titre" name="titre" />
            <input type="hidden" id="date_contrat" name="date_contrat" />
            <input type="hidden" id="description" name="description" />
            <div id="partenaires-container"></div>
            <input type="hidden" id="repartition" name="repartition" />
            <input type="hidden" id="nomPartenariat" name="nomPartenariat" />
            <input type="hidden" id="adresse" name="adresse" />
            <input type="hidden" id="modalitesBancaires" name="modalitesBancaires" />
            <input type="hidden" id="gestionActivites" name="gestionActivites" />
            <input type="hidden" id="departPartenaire" name="departPartenaire" />
            <input type="hidden" id="nonConcurrence" name="nonConcurrence" />
            <input type="hidden" id="modificationAccord" name="modificationAccord" />
            <input type="hidden" id="juridiction" name="juridiction" />
        </form>
    </div>

    <!-- Chatbot pour l'assistance -->
    <div id="chatbox">
        <div id="chatbox-header">
            <i class="fas fa-robot"></i> Chatbot
        </div>
        <div id="messages"></div>
        <input type="text" id="userInput" placeholder="Tapez votre message" />
        <button onclick="sendMessage()">Envoyer</button>
    </div>

    <!-- Bouton pour déconnexion -->
    <div class="logout">
        <a href="../login_pwd/logout.php">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>

    <!-- Scripts pour les fonctionnalités -->
    <script>
        function toggleLogoOptions() {
            const logoOptions = document.getElementById('logo-options');
            const checkbox = document.getElementById('add-logo-checkbox');
            logoOptions.style.display = checkbox.checked ? 'block' : 'none';
        }
    </script>
    <script src="../cree_contrat/creer_form.js"></script>
    <script src="../js_outils/partenaires.js"></script>
    <script src="../php_outils/search_contract.php"></script>
    <script src="../chatbot/chatbot_form.js"></script>
    <script src="../js_outils/notification.js"></script>
    <script src="../gestion/formcor.js"></script>
    <script src="../js_outils/script_couleur.js"></script>
    <script src="../js_outils/search_contract.js"></script>

</body>

</html>