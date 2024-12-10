<?php
$host = 'selim-srv.mysql.database.azure.com'; // Nom du serveur
$username = 'admin@selim-srv'; // Nom d'utilisateur
$password = '98doMvtZ60rX3cKSqzYaV'; // Mot de passe
$database = 'selim'; // Nom de la base

// Connexion à MySQL
$conn = new mysqli($host, $username, $password, $database);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
echo "Connexion réussie à la base de données.";
