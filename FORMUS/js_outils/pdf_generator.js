/*
 * Nom : Usenmez
 * Prénom : Selim
 * Date : 2021-05-06
 * Fonctionnalité : Code JavaScript pour la génération de PDF
 */

// Fonction pour afficher ou masquer les options de logo
function toggleLogoOptions() {
    const logoOptions = document.getElementById('logo-options');
    const logoInput = document.getElementById('logo-input');
    const checkbox = document.getElementById('add-logo-checkbox');

    if (checkbox.checked) {
        // Afficher les options si la case est cochée
        logoOptions.style.display = 'block';
    } else {
        // Masquer les options et réinitialiser le champ du logo
        logoOptions.style.display = 'none';
        logoInput.value = '';
    }
}

// Fonction principale pour générer un PDF à partir des données du contrat
function generatePDF(titre, date, description, nomPartenariat, adresse, modalitesBancaires, gestionActivites, departPartenaire, nonConcurrence, modificationAccord, juridiction, partenaires) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    let yPosition = 20; // Position verticale initiale
    let currentPage = 1; // Compteur de pages
    const pageHeight = doc.internal.pageSize.height;

    // Valeurs par défaut pour les champs vides
    titre = titre || "Titre du contrat non spécifié";
    date = date || "Date non spécifiée";
    description = description || "Description non spécifiée";
    nomPartenariat = nomPartenariat || "Nom non spécifié";
    adresse = adresse || "Adresse non spécifiée";
    modalitesBancaires = modalitesBancaires || "Modalités bancaires non spécifiées";
    gestionActivites = gestionActivites || "Gestion des activités non spécifiée";
    departPartenaire = departPartenaire || "Informations de départ partenaire non spécifiées";
    nonConcurrence = nonConcurrence || "Clause de non-concurrence non spécifiée";
    modificationAccord = modificationAccord || "Modification de l'accord non spécifiée";
    juridiction = juridiction || "Juridiction non spécifiée";
    partenaires = partenaires || [];

    // Fonction pour ajouter une nouvelle page
    function addPage() {
        doc.addPage();
        currentPage++;
        yPosition = 20; // Réinitialisation de la position verticale
        addPageNumber(); // Ajouter le numéro de page
    }

    // Fonction pour ajouter le numéro de la page
    function addPageNumber() {
        doc.setFontSize(10);
        doc.setTextColor(150);
        doc.text(`Page ${currentPage}`, doc.internal.pageSize.getWidth() - 30, pageHeight - 10);
    }

    // Fonction pour vérifier l'espace restant sur la page
    function checkPageSpace(increment) {
        if (yPosition + increment >= pageHeight - 30) {
            addPage();
        }
    }

    // Appliquer une couleur de fond au document
    doc.setFillColor(240, 248, 255);
    doc.rect(0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight(), 'F');

    addPageNumber();

    // Ajouter le titre du contrat
    doc.setFontSize(22);
    doc.setFont("helvetica", "bold");
    doc.setTextColor(0, 51, 102);
    doc.text("Contrat de Partenariat Commercial", doc.internal.pageSize.getWidth() / 2, yPosition, { align: "center" });
    yPosition += 20;

    // Informations générales sur le contrat
    doc.setFontSize(12);
    doc.setFont("helvetica", "normal");
    doc.setTextColor(0, 0, 0);
    doc.text("Titre du contrat: " + titre, 20, yPosition);
    yPosition += 10;
    doc.text("Date du contrat: " + date, 20, yPosition);
    yPosition += 20;

    // Gestion de l'ajout du logo si nécessaire
    const logoCheckbox = document.getElementById('add-logo-checkbox');
    const logoInput = document.getElementById('logo-input');
    const logoPosition = document.getElementById('logo-position').value;

    if (logoCheckbox.checked && logoInput.files.length > 0) {
        const file = logoInput.files[0];
        const reader = new FileReader();

        reader.onload = function(event) {
            const imgData = event.target.result;

            // Définir la position du logo en fonction du choix
            let logoX, logoY;
            switch (logoPosition) {
                case 'top-left':
                    logoX = 10;
                    logoY = 10;
                    break;
                case 'top-right':
                    logoX = doc.internal.pageSize.getWidth() - 40;
                    logoY = 10;
                    break;
                case 'bottom-left':
                    logoX = 10;
                    logoY = doc.internal.pageSize.getHeight() - 40;
                    break;
                case 'bottom-right':
                    logoX = doc.internal.pageSize.getWidth() - 40;
                    logoY = doc.internal.pageSize.getHeight() - 40;
                    break;
                default:
                    logoX = 10;
                    logoY = 10;
            }

            // Ajouter l'image au document
            doc.addImage(imgData, 'JPEG', logoX, logoY, 30, 30);
            finalizePDF(); // Finaliser le PDF après l'ajout du logo
        };

        reader.readAsDataURL(file);
    } else {
        finalizePDF(); // Finaliser directement si aucun logo n'est ajouté
    }

    // Fonction pour finaliser et enregistrer le PDF
    function finalizePDF() {
        // Ajout des sections du contrat
        checkPageSpace(30); 
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("1. NOM DU PARTENARIAT ET ACTIVITÉ", 25, yPosition);
        yPosition += 15;

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(0, 0, 0);
        doc.text("1.1 Description: " + description, 20, yPosition);
        yPosition += 10;
        doc.text("1.2 Nom du partenariat: " + nomPartenariat, 20, yPosition);
        yPosition += 10;
        doc.text("1.3 Adresse: " + adresse, 20, yPosition);
        yPosition += 20;

        checkPageSpace(30);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("2. MODALITÉS BANCAIRES", 25, yPosition);
        yPosition += 15;

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(0, 0, 0);
        doc.text("Modalités bancaires: " + modalitesBancaires, 20, yPosition);
        yPosition += 20;

        checkPageSpace(30);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("3. GESTION DES ACTIVITÉS", 25, yPosition);
        yPosition += 15;

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(0, 0, 0);
        doc.text(gestionActivites, 20, yPosition);
        yPosition += 20;

        checkPageSpace(30);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("4. PARTENAIRES", 25, yPosition);
        yPosition += 15;

        if (Array.isArray(partenaires)) {
            partenaires.forEach((partenaire, index) => {
                checkPageSpace(10);
                doc.setFontSize(12);
                doc.setFont("helvetica", "normal");
                doc.setTextColor(0, 0, 0);
                doc.text(`${index + 1}. ${partenaire.nom} - Contribution: ${partenaire.contribution}`, 20, yPosition);
                yPosition += 10;
            });
        }

        checkPageSpace(30);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("5. DÉPART PARTENAIRE", 25, yPosition);
        yPosition += 10;

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(0, 0, 0);
        doc.text(departPartenaire, 20, yPosition);
        yPosition += 20;

        checkPageSpace(30);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("6. CLAUSE DE NON-CONCURRENCE", 25, yPosition);
        yPosition += 10;

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(0, 0, 0);
        doc.text(nonConcurrence, 20, yPosition);
        yPosition += 20;

        checkPageSpace(30);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("7. MODIFICATION DE L'ACCORD", 25, yPosition);
        yPosition += 10;

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(0, 0, 0);
        doc.text(modificationAccord, 20, yPosition);
        yPosition += 20;

        checkPageSpace(30);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.setFillColor(0, 51, 102);
        doc.setTextColor(255, 255, 255);
        doc.rect(20, yPosition - 5, 170, 10, 'F');
        doc.text("8. JURIDICTION", 25, yPosition);
        yPosition += 10;

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(0, 0, 0);
        doc.text(juridiction, 20, yPosition);

        addPageNumber();
        doc.save("contrat_" + titre + ".pdf");
    
        addPageNumber();
        doc.save("contrat_" + titre + ".pdf"); // Sauvegarder le fichier PDF
    }
}