// Usenmez Selim
// 2021-05-06
// code JAvascripte l'affichage du mtos de passe lors de la création du compte

function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm_password');
    const passwordType = passwordField.type === 'password' ? 'text' : 'password';
    
    passwordField.type = passwordType;
    confirmPasswordField.type = passwordType;
}

document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('show_password');
    if (checkbox) {
        checkbox.addEventListener('click', togglePasswordVisibility);
    }
});