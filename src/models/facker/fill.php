<?php
require 'vendor/autoload.php';
require 'src/models/db_connection.php';
$faker = Faker\Factory::create('fr_FR');

// Empty tables
// Empty utilisateur
$pdo->exec("SET FOREIGN_KEY_CHECKS=0");
$pdo->exec("TRUNCATE TABLE utilisateur");
$pdo->exec("TRUNCATE TABLE lieu");
$pdo->exec("TRUNCATE TABLE organisateur");
$pdo->exec("TRUNCATE TABLE evenement");
$pdo->exec("SET FOREIGN_KEY_CHECKS=1");
echo "La table utilisateur a été vidé";


//  fill utilisateur
$utilisateurs=[];
for ($i=0;$i<30;$i++){
    $hash = password_hash('user',PASSWORD_BCRYPT);
    $pdo->exec("INSERT INTO utilisateur
        (nom, email, password, role) 
        VALUES 
        ('{$faker->name}','{$faker->email}','{$hash}','utilisateur')
    ");
    $utilisateurs[] = $pdo->lastInsertId();
}
echo "La table utilisateur a été rempli";

// Create user admin
$hash = password_hash('osm',PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO utilisateur
    (nom, email, password, role) 
    VALUES 
    ('osm','osmjom@gmail.com','{$hash}','administrateur')
");

//  fill lieu
$lieux = [];
for ($i=0;$i<20;$i++){
    $pdo->exec("INSERT INTO lieu
        (nom, adresse) 
        VALUES 
        ('{$faker->name}','{$faker->address}')
    ");
    $lieux[] = $pdo->lastInsertId();
}
echo "La table lieu a été rempli";

//  fill organisateur
$organisateur = [];
for ($i=0;$i<15;$i++){
    $pdo->exec("INSERT INTO organisateur
        (nom, contact) 
        VALUES 
        ('{$faker->name}','{$faker->phoneNumber()}')
    ");
    $organisateur[]=$pdo->lastInsertId();
}
echo "La table organisateur a été rempli";

//  fill evenement
$evenements = [];
for ($i=0;$i<25;$i++){
    $lieu_id = rand(1,20);
    $organisateur_id = rand(1,15);
    $date = $faker->dateTimeBetween('+1 week', '+30 week');
    $formattedDate = $date->format('Y-m-d H:i:s');
    $place = rand(50,150);
    $pdo->exec("INSERT INTO evenement
        (nom, description, date,place,cover, lieu_id, organisateur_id) 
        VALUES 
        ('{$faker->name}','{$faker->paragraph(5)}','{$formattedDate}','{$place}','https://placehold.co/600x400?text=Hello+World','{$lieu_id}','{$organisateur_id}')
    ");
    $evenements[]=$pdo->lastInsertId();
}
echo "La table evenement a été rempli";

//  fill inscription
$inscriptions = [];
for ($i=0;$i<72;$i++){
    $utilisateur_id = rand(1,30);
    $evenement_id = rand(1,25);
    $pdo->exec("INSERT INTO inscription
        (utilisateur_id, evenement_id) 
        VALUES 
        ('{$utilisateur_id}','{$evenement_id}')
    ");
    $inscriptions[]=$pdo->lastInsertId();
}
echo "La table inscription a été rempli";

