<?php
// require_once 'db_connection.php';



    function getEvent($pdo){
        $stmt = $pdo->prepare('SELECT * FROM evenement');
        $stmt->execute();
        $evenemtns = $stmt->fetchAll();
        return $evenemtns;
    }

    function getOneEvent($pdo,$id){
        $stmt = $pdo->prepare('SELECT * FROM evenement where id = :id');
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $evenement = $stmt->fetch();
        return $evenement;
    }



?>