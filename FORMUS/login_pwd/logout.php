<!-- Usenmez Selim
    2021-05-06
    page php pour la déconnection logout -->

<?php
session_start();
session_destroy();
header("Location: ../login_pwd/login.php");
exit();
?>