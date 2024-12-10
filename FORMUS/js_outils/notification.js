// Usenmez Selim
// 2021-05-06
// code JAvascripte pour la gestion des notifications

document.addEventListener('DOMContentLoaded', function() {
    const notification = document.getElementById('notification');
    if (notification) {
        setTimeout(function() {
            notification.style.animation = 'fadeOut 0.2s ease forwards';
        }, 3000);
    }
});