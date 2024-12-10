/*
 * Nom : Usenmez
 * Prénom : Selim
 * Date : 2021-05-06
 * Fonctionnalité : Code JavaScript pour la page "Créer Contrat"
 */


// Fonction pour afficher une info-bulle contextuelle en fonction de la section sélectionnée
function showPopup(section) {
    var popup = document.getElementById("popup");
    var popupText = document.getElementById("popup-text");

    // Affichage du texte explicatif correspondant à la section donnée
    switch(section) {
        case 'date_contrat':
            popupText.innerHTML = "Date à laquelle le partenariat débute officiellement.";
            break;
        case 'titre':
            popupText.innerHTML = "Le titre du contrat décrit brièvement l'objet du partenariat.";
            break;
        case 'description':
            popupText.innerHTML = "La description donne un aperçu général du contrat et des termes du partenariat.";
            break;
        case 'partenaire1':
            popupText.innerHTML = "Nom du premier partenaire participant au contrat.";
            break;
        case 'contribution1':
            popupText.innerHTML = "Contribution en capital ou en nature du partenaire 1.";
            break;
        case 'repartition':
            popupText.innerHTML = "Manière dont les bénéfices et pertes seront répartis.";
            break;
        case 'nomPartenariat':
            popupText.innerHTML = "Nom sous lequel le partenariat sera enregistré.";
            break;
        case 'adresse':
            popupText.innerHTML = "Adresse officielle du siège du partenariat.";
            break;
        case 'modalitesBancaires':
            popupText.innerHTML = "Modalités bancaires du partenariat.";
            break;
        case 'gestionActivites':
            popupText.innerHTML = "Détails de la gestion des activités du partenariat.";
            break;
        case 'departPartenaire':
            popupText.innerHTML = "Conditions du départ d'un partenaire.";
            break;
        case 'nonConcurrence':
            popupText.innerHTML = "Durée de la clause de non-concurrence pour les partenaires.";
            break;
        case 'modificationAccord':
            popupText.innerHTML = "Conditions nécessaires pour modifier l'accord de partenariat.";
            break;
        case 'juridiction':
            popupText.innerHTML = "Région de juridiction qui régit le contrat.";
            break;
        default:
            // Si la section n'est pas reconnue, afficher une info-bulle vide
            popupText.innerHTML = "";
    }

    // Positionner l'info-bulle à proximité du curseur de la souris
    popup.style.top = event.clientY + 'px'; 
    popup.style.left = event.clientX + 'px'; 

    // Rendre l'info-bulle visible
    popup.classList.remove("hidden");
    popup.classList.add("visible");
}

// Fonction pour masquer l'info-bulle
function hidePopup() {
    var popup = document.getElementById("popup");
    // Retirer la classe visible et ajouter la classe cachée pour masquer l'info-bulle
    popup.classList.remove("visible");
    popup.classList.add("hidden");
}
