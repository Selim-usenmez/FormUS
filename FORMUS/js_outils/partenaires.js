/*
 * Nom : Usenmez
 * Prénom : Selim
 * Date : 2021-05-06
 * Fonctionnalité : Code JavaScript pour l'ajout et la gestion des partenaires
 */

// Initialisation du compteur pour suivre le nombre de partenaires ajoutés
let partenaireCount = 0; 

// Fonction pour ajouter un nouveau partenaire au formulaire
function ajouterPartenaire() {
    partenaireCount++;

    // Récupération du conteneur où seront ajoutés les partenaires
    const partenairesContainer = document.getElementById('partenaires-container');

    // Création d'un nouveau champ pour le nom du partenaire
    const newPartenaireDiv = document.createElement('div');
    newPartenaireDiv.classList.add('form-group');
    newPartenaireDiv.id = 'partenaire-group' + partenaireCount;

    const partenaireLabel = document.createElement('label');
    partenaireLabel.setAttribute('for', 'partenaire' + partenaireCount);
    partenaireLabel.innerHTML = `Nom du partenaire ${partenaireCount} :`;
    newPartenaireDiv.appendChild(partenaireLabel);

    const partenaireInput = document.createElement('input');
    partenaireInput.type = 'text';
    partenaireInput.id = 'partenaire' + partenaireCount;
    partenaireInput.name = 'partenaire' + partenaireCount;
    partenaireInput.placeholder = `Nom du partenaire ${partenaireCount}`;
    newPartenaireDiv.appendChild(partenaireInput);

    partenairesContainer.appendChild(newPartenaireDiv);

    // Création d'un nouveau champ pour la contribution du partenaire
    const newContributionDiv = document.createElement('div');
    newContributionDiv.classList.add('form-group');
    newContributionDiv.id = 'contribution-group' + partenaireCount;

    const contributionLabel = document.createElement('label');
    contributionLabel.setAttribute('for', 'contribution' + partenaireCount);
    contributionLabel.innerHTML = `Contribution du partenaire ${partenaireCount} :`;
    newContributionDiv.appendChild(contributionLabel);

    const contributionTextarea = document.createElement('textarea');
    contributionTextarea.id = 'contribution' + partenaireCount;
    contributionTextarea.name = 'contribution' + partenaireCount;
    contributionTextarea.placeholder = `Détaillez la contribution du partenaire ${partenaireCount}`;
    newContributionDiv.appendChild(contributionTextarea);

    partenairesContainer.appendChild(newContributionDiv);

    // Faire défiler pour afficher le nouveau partenaire ajouté
    newPartenaireDiv.scrollIntoView({ behavior: "smooth" });
}

// Fonction pour ajouter un partenaire via la chatbox si aucun n'est encore ajouté
function ajouterPartenaireViaChatbox() {
    if (partenaireCount === 0) {
        ajouterPartenaire(); 
    }
}

// Gestionnaire d'événement pour vérifier les champs des partenaires avant de soumettre le formulaire
document.getElementById('creer-contrat').addEventListener('click', function(event) {
    const partenaires = document.querySelectorAll('[id^="partenaire"]');
    const contributions = document.querySelectorAll('[id^="contribution"]');

    // Validation des champs des partenaires et contributions
    for (let i = 0; i < partenaires.length; i++) {
        const partenaireValue = partenaires[i].value.trim();
        const contributionValue = contributions[i].value.trim();
        
        if (partenaireValue === '' || contributionValue === '') {
            alert(`Veuillez remplir les informations du partenaire ${i + 1} et de sa contribution.`);
            event.preventDefault();
            return;
        }
    }

    // Soumission du formulaire si tous les champs sont remplis
    event.target.closest('form').submit();
});

// Fonction pour supprimer le dernier partenaire ajouté
function supprimerPartenaire() {
    if (partenaireCount > 1) {
        const partenaireGroup = document.getElementById('partenaire-group' + partenaireCount);
        const contributionGroup = document.getElementById('contribution-group' + partenaireCount);

        if (partenaireGroup) partenaireGroup.remove();
        if (contributionGroup) contributionGroup.remove();

        partenaireCount--;
    }
}