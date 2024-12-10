// Usenmez Selim
// 2021-05-06
// code JAvascripte mise en forme du contrat

function afficherFormulaire() {
    const formulaire = document.querySelector('.form-container');
    formulaire.style.visibility = 'visible';
    formulaire.style.opacity = '1';
}

function cacherFormulaire() {
    const formulaire = document.querySelector('.form-container');
    formulaire.style.visibility = 'hidden';
    formulaire.style.opacity = '0';
}