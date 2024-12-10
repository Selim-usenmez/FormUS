/*
 * Nom : Usenmez
 * Prénom : Selim
 * Date : 2021-05-06
 * Fonctionnalité : Code JavaScript pour la gestion et l'affichage des données dans la page "Créer contrat"
 */

// Initialisation des variables pour suivre les étapes et stocker les données utilisateur
let currentStep = 0;
let userData = {
    titre: '',
    date_contrat: '',
    description: '',
    nombrePartenaires: 1,
    partenaires: [], 
    repartition: '',
    nomPartenariat: '',
    adresse: '',
    modalitesBancaires: '',
    gestionActivites: '',
    departPartenaire: '',
    nonConcurrence: '',
    modificationAccord: '',
    juridiction: ''
};

// Fonction pour obtenir la date actuelle au format yyyy-mm-dd
function getCurrentDateForInput() {
    let today = new Date();
    let day = ("0" + today.getDate()).slice(-2);
    let month = ("0" + (today.getMonth() + 1)).slice(-2);
    let year = today.getFullYear();
    return `${year}-${month}-${day}`;
}

// Fonction pour convertir une date au format jj/mm/aaaa vers le format yyyy-mm-dd
function convertDateToInputFormat(date) {
    let [day, month, year] = date.split('/');
    if (year.length === 2) {
        year = "20" + year;
    }
    return `${year}-${month}-${day}`;
}

// Définition des étapes du chatbot avec leurs questions et champs associés
let steps = [
    { question: "Quel est le titre du contrat ?", field: "titre" },
    { question: "Quelle est la date du contrat ? (format jj/mm/aa ou jj/mm/aaaa)", field: "date_contrat" },
    { question: "Entrez la description du contrat :", field: "description" },
    { question: "Combien de partenaires ?", field: "nombrePartenaires" }
];

// Initialisation du chatbot à l'ouverture de la page
document.addEventListener("DOMContentLoaded", function () {
    let messages = document.getElementById('messages');
    messages.innerHTML += `<div>Chatbot: ${steps[0].question}</div>`;

    // Pré-remplir le champ de la date avec la date actuelle
    let dateContratInput = document.getElementById('date_contrat');
    dateContratInput.value = getCurrentDateForInput();
});

// Fonction pour envoyer un message et gérer la logique du chatbot
function sendMessage() {
    let input = document.getElementById('userInput').value.trim();
    let messages = document.getElementById('messages');

    if (input === "") return; // Ignorer les messages vides

    // Commande pour supprimer un partenaire
    if (input.toLowerCase().startsWith("supprimer partenaire")) {
        let partenaireNumber = parseInt(input.split(" ")[2]);
        if (!isNaN(partenaireNumber) && partenaireNumber > 0 && partenaireNumber <= userData.partenaires.length) {
            supprimerPartenaire(partenaireNumber - 1);
            messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: Partenaire ${partenaireNumber} supprimé.</div>`;
        } else {
            messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: Numéro de partenaire invalide. Veuillez réessayer.</div>`;
        }
        document.getElementById('userInput').value = '';
        return;
    }

    // Gestion des étapes du chatbot
    if (steps[currentStep].field === "date_contrat") {
        // Validation du format de la date
        const dateRegex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{2}|\d{4})$/;
        if (!dateRegex.test(input)) {
            messages.innerHTML += `<div>Chatbot: Merci d'entrer une date valide au format jj/mm/aa ou jj/mm/aaaa.</div>`;
            return;
        }

        // Conversion et stockage de la date
        userData.date_contrat = input;
        document.getElementById('date_contrat').value = convertDateToInputFormat(input);

        // Passer à la question suivante
        messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
        currentStep++;
    } else if (steps[currentStep].field === "nombrePartenaires") {
        // Validation du nombre de partenaires
        userData.nombrePartenaires = parseInt(input);
        if (isNaN(userData.nombrePartenaires) || userData.nombrePartenaires <= 0) {
            messages.innerHTML += `<div>Chatbot: Entrez un nombre valide de partenaires.</div>`;
            return;
        }

        // Ajouter dynamiquement les étapes pour chaque partenaire
        for (let i = 1; i <= userData.nombrePartenaires; i++) {
            steps.push({ question: `Nom du partenaire ${i} :`, field: `partenaire${i}` });
            steps.push({ question: `Contribution du partenaire ${i} :`, field: `contribution${i}` });
        }

        // Ajouter les étapes finales
        steps.push({ question: "Décrivez la répartition des bénéfices et pertes :", field: "repartition" });
        steps.push({ question: "Nom du partenariat :", field: "nomPartenariat" });
        steps.push({ question: "Adresse officielle :", field: "adresse" });
        steps.push({ question: "Modalités bancaires et financières :", field: "modalitesBancaires" });
        steps.push({ question: "Détails de la gestion des activités :", field: "gestionActivites" });
        steps.push({ question: "Conditions du départ d'un partenaire :", field: "departPartenaire" });
        steps.push({ question: "Durée de la clause de non-concurrence :", field: "nonConcurrence" });
        steps.push({ question: "Conditions de modification de l'accord :", field: "modificationAccord" });
        steps.push({ question: "Région de juridiction :", field: "juridiction" });

        // Initialisation des données des partenaires
        userData.partenaires = Array.from({ length: userData.nombrePartenaires }, () => ({ nom: '', contribution: '' }));

        messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
        currentStep++;
    } else if (currentStep >= 4) {
        // Stockage des données pour les partenaires ou autres champs
        let field = steps[currentStep].field;

        if (field.startsWith('partenaire')) {
            let partenaireIndex = parseInt(field.replace('partenaire', '')) - 1;
            userData.partenaires[partenaireIndex].nom = input;
        } else if (field.startsWith('contribution')) {
            let partenaireIndex = parseInt(field.replace('contribution', '')) - 1;
            userData.partenaires[partenaireIndex].contribution = input;
        } else {
            userData[field] = input;
        }

        // Afficher la prochaine question ou terminer le processus
        if (currentStep < steps.length - 1) {
            messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
        } else {
            messages.innerHTML += `<div>Chatbot: Merci, nous allons maintenant remplir le formulaire.</div>`;
            fillForm();
        }

        currentStep++;
    } else {
        // Gestion générique des champs
        let field = steps[currentStep].field;
        userData[field] = input;
        messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
        currentStep++;
    }

    document.getElementById('userInput').value = '';
}

// Fonction pour remplir automatiquement les champs du formulaire avec les données collectées
function fillForm() {
    document.getElementById('titre').value = userData.titre;
    document.getElementById('date_contrat').value = convertDateToInputFormat(userData.date_contrat);
    document.getElementById('description').value = userData.description;

    // Remplissage dynamique des partenaires
    const partenairesContainer = document.getElementById('partenaires-container');
    partenairesContainer.innerHTML = '';

    userData.partenaires.forEach((partenaire, i) => {
        const partenaireDiv = document.createElement('div');
        partenaireDiv.classList.add('form-group');

        const partenaireLabel = document.createElement('label');
        partenaireLabel.textContent = `Nom du partenaire ${i + 1} :`;
        const partenaireInput = document.createElement('input');
        partenaireInput.type = 'text';
        partenaireInput.name = `partenaire${i + 1}`;
        partenaireInput.value = partenaire.nom;

        partenaireDiv.appendChild(partenaireLabel);
        partenaireDiv.appendChild(partenaireInput);

        const contributionDiv = document.createElement('div');
        contributionDiv.classList.add('form-group');
        const contributionLabel = document.createElement('label');
        contributionLabel.textContent = `Contribution du partenaire ${i + 1} :`;
        const contributionInput = document.createElement('textarea');
        contributionInput.name = `contribution${i + 1}`;
        contributionInput.value = partenaire.contribution;

        contributionDiv.appendChild(contributionLabel);
        contributionDiv.appendChild(contributionInput);

        partenairesContainer.appendChild(partenaireDiv);
        partenairesContainer.appendChild(contributionDiv);
    });

    // Remplir les autres champs du formulaire
    document.getElementById('repartition').value = userData.repartition;
    document.getElementById('nomPartenariat').value = userData.nomPartenariat;
    document.getElementById('adresse').value = userData.adresse;
    document.getElementById('modalitesBancaires').value = userData.modalitesBancaires;
    document.getElementById('gestionActivites').value = userData.gestionActivites;
    document.getElementById('departPartenaire').value = userData.departPartenaire;
    document.getElementById('nonConcurrence').value = userData.nonConcurrence;
    document.getElementById('modificationAccord').value = userData.modificationAccord;
    document.getElementById('juridiction').value = userData.juridiction;
}