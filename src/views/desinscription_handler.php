<?php


require_once __DIR__ . '/../models/db_connection.php';
require_once __DIR__ . '/../controllers/Inscription.php';

session_start();
if (isset($_SESSION['id']) && isset($_GET['id'])) {
    $utilisateur_id = intval($_SESSION['id']);
    $evenement_id = intval($_GET['id']);

    deleteInscription($pdo, $utilisateur_id, $evenement_id) ;

    // Redirigez vers une page de confirmation ou de l'événement
    header('Location: ?page=evenement_detail&id='.$evenement_id);
    exit();
} else {
    echo "Erreur: utilisateur non connecté ou événement non spécifié.";
}
?>