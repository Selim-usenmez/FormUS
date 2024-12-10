<?php
$host = 'selim-srv.mysql.database.azure.com';
$username = 'admin@selim-srv';
$password = 'votre_mot_de_passe';
$database = 'selim';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Chemin vers le fichier SQL
$sqlFile = __DIR__ . '/Selim.sql'; // Assurez-vous que database.sql est au bon emplacement
$sqlContent = file_get_contents($sqlFile);

if ($conn->multi_query($sqlContent)) {
    echo "Importation réussie.";
} else {
    echo "Erreur lors de l'importation : " . $conn->error;
}

$conn->close();
