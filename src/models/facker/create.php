<?php
require 'src/models/db_connection.php';




// Create utilisateur table
$pdo->exec("CREATE TABLE utilisateur (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('utilisateur', 'administrateur') NOT NULL
    )");
echo "La table utilisateur a été créé";

// Create lieu table
$pdo->exec("CREATE TABLE lieu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255)
)");
echo "La table lieu a été créé";

// Create organisateur table
$pdo->exec("CREATE TABLE organisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    contact VARCHAR(255)
)");
echo "La table organisateur a été créé";

// Create evenement table
$pdo->exec("CREATE TABLE evenement (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT,
        date DATETIME NOT NULL,
        place INT,
        cover VARCHAR(255),
        lieu_id INT,
        organisateur_id INT,
        FOREIGN KEY (lieu_id) REFERENCES lieu(id),
        FOREIGN KEY (organisateur_id) REFERENCES organisateur(id)
    )");
echo "La table evenement a été créé";

// Create inscription table
$pdo->exec("CREATE TABLE inscription (
        id INT AUTO_INCREMENT PRIMARY KEY,
        utilisateur_id INT,
        evenement_id INT,
        FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id),
        FOREIGN KEY (evenement_id) REFERENCES evenement(id)
    )");
echo "La table inscription a été créé";



