// Usenmez Selim
// 2021-05-06
// code JAvascripte la gestion de la couleur du fond 

(function() {
    function changerCouleur() {
        const couleur1 = `#${Math.floor(Math.random() * 16777215).toString(16)}`;
        const couleur2 = `#${Math.floor(Math.random() * 16777215).toString(16)}`;

        document.body.style.background = `linear-gradient(135deg, ${couleur1}, ${couleur2})`;

        localStorage.setItem('couleur1', couleur1);
        localStorage.setItem('couleur2', couleur2);
    }

    function appliquerCouleurStockee() {
        const couleur1 = localStorage.getItem('couleur1');
        const couleur2 = localStorage.getItem('couleur2');

        if (couleur1 && couleur2) {
            document.body.style.background = `linear-gradient(135deg, ${couleur1}, ${couleur2})`;
        }
    }

    document.addEventListener('DOMContentLoaded', appliquerCouleurStockee);

    document.addEventListener('DOMContentLoaded', function() {
        const changeColorBtn = document.getElementById('change-color-btn');
        if (changeColorBtn) {
            changeColorBtn.addEventListener('click', changerCouleur);
        }
    });
})();