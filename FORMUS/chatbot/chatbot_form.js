
/*
 * Nom : Usenmez
 * Prénom : Selim
 * Date : 2024-11-20
 * Fonctionnalité : Code JavaScript pour le chatbot
 */



// Initialisation des variables globales pour suivre l'état du chatbot et stocker les données utilisateur
(function () {
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

    // Fonction pour obtenir la date actuelle au format yyyy-mm-dd (compatible avec les champs de type date)
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
    
    // Tableau des étapes de dialogue du chatbot avec leurs questions associées et champs à remplir
    let steps = [
        { question: "Quel est le titre du contrat ?", field: "titre" },
        { question: "Quelle est la date du contrat ? (format jj/mm/aa ou jj/mm/aaaa)", field: "date_contrat" },
        { question: "Entrez la description du contrat :", field: "description" },
        { question: "Combien de partenaires ?", field: "nombrePartenaires" }
    ];

    // Écouteur d'événement pour initialiser le chatbot à l'ouverture de la page et afficher la première question
    document.addEventListener("DOMContentLoaded", function () {
        let messages = document.getElementById('messages');
        messages.innerHTML += `<div>Chatbot: ${steps[0].question}</div>`;

        // Pré-remplir la date du contrat avec la date actuelle
        let dateContratInput = document.getElementById('date_contrat');
        dateContratInput.value = getCurrentDateForInput();
    });

    // Fonction pour faire défiler le conteneur des messages vers le bas automatiquement
    function scrollToBottom() {
        let messagesContainer = document.getElementById('messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Fonction pour envoyer un message de l'utilisateur et traiter les réponses du chatbot
    function sendMessage() {
        let input = document.getElementById('userInput').value.trim();
        let messages = document.getElementById('messages');

        if (input === "") return; // Ignorer les messages vides

        // Gestion des commandes spécifiques, comme "supprimer partenaire"
        if (input.toLowerCase().startsWith("supprimer partenaire")) {
            let partenaireNumber = parseInt(input.split(" ")[2]);
            if (!isNaN(partenaireNumber) && partenaireNumber > 0 && partenaireNumber <= userData.partenaires.length) {
                supprimerPartenaire(partenaireNumber - 1);
                messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: Partenaire ${partenaireNumber} supprimé.</div>`;
            } else {
                messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: Numéro de partenaire invalide. Veuillez réessayer.</div>`;
            }
            document.getElementById('userInput').value = ''; 
            scrollToBottom();
            return;
        }

        // Vérification de la validité des dates saisies par l'utilisateur
        if (steps[currentStep].field === "date_contrat") {
            const dateRegex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{2}|\d{4})$/;
            if (!dateRegex.test(input)) {
                messages.innerHTML += `<div>Chatbot: Merci d'entrer une date valide au format jj/mm/aa ou jj/mm/aaaa.</div>`;
                scrollToBottom(); 
                return; 
            }

            userData.date_contrat = input;
            document.getElementById('date_contrat').value = convertDateToInputFormat(input);

            messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
            currentStep++;
        } else if (steps[currentStep].field === "nombrePartenaires") {
            userData.nombrePartenaires = parseInt(input);

            // Ajout dynamique des étapes pour chaque partenaire en fonction du nombre de partenaires saisi
            if (isNaN(userData.nombrePartenaires) || userData.nombrePartenaires <= 0) {
                messages.innerHTML += `<div>Chatbot: Entrez un nombre valide de partenaires.</div>`;
                scrollToBottom();
                return;
            }

            for (let i = 1; i <= userData.nombrePartenaires; i++) {
                steps.push({ question: `Nom du partenaire ${i} :`, field: `partenaire${i}` });
                steps.push({ question: `Contribution du partenaire ${i} :`, field: `contribution${i}` });
            }

            steps.push({ question: "Décrivez la répartition des bénéfices et pertes :", field: "repartition" });
            steps.push({ question: "Nom du partenariat :", field: "nomPartenariat" });
            steps.push({ question: "Adresse officielle :", field: "adresse" });
            steps.push({ question: "Modalités bancaires et financières :", field: "modalitesBancaires" });
            steps.push({ question: "Détails de la gestion des activités :", field: "gestionActivites" });
            steps.push({ question: "Conditions du départ d'un partenaire :", field: "departPartenaire" });
            steps.push({ question: "Durée de la clause de non-concurrence :", field: "nonConcurrence" });
            steps.push({ question: "Conditions de modification de l'accord :", field: "modificationAccord" });
            steps.push({ question: "Région de juridiction :", field: "juridiction" });

            userData.partenaires = Array.from({ length: userData.nombrePartenaires }, () => ({ nom: '', contribution: '' }));

            messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
            currentStep++;
        } else if (currentStep >= 4) {
            let field = steps[currentStep].field;

            // Mise à jour des données utilisateur avec les réponses saisies
            if (field.startsWith('partenaire')) {
                let partenaireIndex = parseInt(field.replace('partenaire', '')) - 1;
                userData.partenaires[partenaireIndex].nom = input;
            } else if (field.startsWith('contribution')) {
                let partenaireIndex = parseInt(field.replace('contribution', '')) - 1;
                userData.partenaires[partenaireIndex].contribution = input;
            } else {
                userData[field] = input;
            }

            if (currentStep < steps.length - 1) {
                messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
            } else {
                messages.innerHTML += `<div>Chatbot: Merci, nous allons maintenant remplir le formulaire.</div>`;
                fillForm();
            }

            currentStep++;
        } else {
            let field = steps[currentStep].field;
            userData[field] = input;
            messages.innerHTML += `<div>You: ${input}</div><div>Chatbot: ${steps[currentStep + 1].question}</div>`;
            currentStep++;
        }

        document.getElementById('userInput').value = '';
        scrollToBottom();
    }

    // Fonction pour remplir automatiquement les champs du formulaire HTML avec les données collectées
    function fillForm() {
        if (document.getElementById('titre')) {
            document.getElementById('titre').value = userData.titre;
        }
        if (document.getElementById('date_contrat')) {
            document.getElementById('date_contrat').value = convertDateToInputFormat(userData.date_contrat);
        }
        if (document.getElementById('description')) {
            document.getElementById('description').value = userData.description;
        }
    
        const partenairesContainer = document.getElementById('partenaires-container');
        if (partenairesContainer) {
            partenairesContainer.innerHTML = '';
    
            // Ajout dynamique des champs pour les partenaires et leurs contributions dans le formulaire
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
        }
    
        // Remplir les champs restants dans le formulaire avec les données utilisateur
        const remainingFields = [
            'repartition', 'nomPartenariat', 'adresse', 'modalitesBancaires', 
            'gestionActivites', 'departPartenaire', 'nonConcurrence', 
            'modificationAccord', 'juridiction'
        ];
        remainingFields.forEach(field => {
            const element = document.getElementById(field);
            if (element) {
                element.value = userData[field];
            }
        });
    
        // Soumission automatique du formulaire une fois toutes les données collectées
        const form = document.getElementById('creer-contrat-form');
        if (form) {
            form.submit();
        }
    }
    

    // Gestion du déplacement de la boîte de dialogue du chatbot (drag-and-drop)
    let chatbox = document.getElementById("chatbox");
    let isDragging = false;
    let offsetX, offsetY;
    let clickX, clickY;
    let clickThreshold = 2;

    document.getElementById("chatbox-header").addEventListener("mousedown", function (e) {
        isDragging = true;
        offsetX = e.clientX - chatbox.offsetLeft;
        offsetY = e.clientY - chatbox.offsetTop;
        clickX = e.clientX;
        clickY = e.clientY;
        e.preventDefault();
    });

    document.addEventListener("mousemove", function (e) {
        if (isDragging) {
            chatbox.style.left = (e.clientX - offsetX) + "px";
            chatbox.style.top = (e.clientY - offsetY) + "px";
        }
    });

    document.addEventListener("mouseup", function (e) {
        isDragging = false;
        
        // Gestion du clic sur l'en-tête du chatbot pour l'expansion ou la réduction de la boîte de dialogue
        if (Math.abs(e.clientX - clickX) < clickThreshold && Math.abs(e.clientY - clickY) < clickThreshold) {
            if (!chatbox.classList.contains("expanded")) {
                chatbox.classList.add("expanded");
                chatbox.style.top = (chatbox.offsetTop - 360) + "px"; 
            } else {
                chatbox.classList.remove("expanded");
                chatbox.style.top = (chatbox.offsetTop + 360) + "px";
            }
        }
    });

    // Écouteur pour l'envoi de messages via la touche "Entrée"
    document.getElementById("userInput").addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            sendMessage();
        }
    });

})();

// Fonction pour afficher le formulaire lorsque le chatbot interagit
function afficherFormulaire() {
    const formulaire = document.querySelector('.form-container');
    formulaire.classList.remove('hidden'); 
}

// Fonction pour cacher le formulaire après l'envoi des données
function onFormulaireEnvoye() {

    cacherFormulaire();
}