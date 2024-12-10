/*
 * Nom : Usenmez
 * Prénom : Selim
 * Date : 2021-05-06
 * Fonctionnalité : Gestion de l'animation Netflix et affichage du formulaire avec son
 */

document.addEventListener('DOMContentLoaded', () => {
    const netflixVideo = document.getElementById('netflix-video');
    const animationContainer = document.querySelector('.animation-container');
    const formContainer = document.querySelector('.form-container');
    let animationStarted = false;

    // Masquer l'animation par défaut
    animationContainer.classList.add('hidden');

    // Fonction pour démarrer le son et l'animation
    function startAnimationAndSound() {
        if (!animationStarted) {
            animationStarted = true; // Empêche plusieurs déclenchements

            // Montrer l'animation
            animationContainer.classList.remove('hidden');

            // Activer le son
            netflixVideo.muted = false;
            netflixVideo.volume = 1;

            netflixVideo.play().then(() => {
                console.log("Son activé et vidéo jouée.");
            }).catch((error) => {
                console.warn("Impossible de jouer le son :", error);
            });

            // Lancer l'animation et afficher le formulaire après 4 secondes
            setTimeout(() => {
                animationContainer.classList.add('hidden'); // Cache l'animation
                formContainer.classList.remove('hidden'); // Affiche le formulaire
                formContainer.classList.add('active'); // Ajoute l'effet de fondu
            }, 4000); // Temps total de l'animation (4s)
        }
    }

    // Détecter le mouvement de la souris pour démarrer
    document.addEventListener('mousemove', (event) => {
        if (!animationStarted && (event.movementX !== 0 || event.movementY !== 0)) {
            startAnimationAndSound();
        }
    }, { once: true });
});