<?php
require 'src/models/db_connection.php';
$pdo->exec("SET FOREIGN_KEY_CHECKS=0");
$pdo->exec("DROP TABLE utilisateur");
$pdo->exec("DROP TABLE evenement");
$pdo->exec("DROP TABLE inscription");
$pdo->exec("DROP TABLE organisateur");
$pdo->exec("DROP TABLE lieu");
$pdo->exec("SET FOREIGN_KEY_CHECKS=1");

echo "Les tables ont été supprimés";