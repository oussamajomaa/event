<?php

function addInscription($pdo,$utilisateur_id,$evenement_id){
    try {
        if (findOneInscription($pdo,$utilisateur_id,$evenement_id)){
            echo "Vous ếtes déjà inscrit à cet événement";
        } else {
            $stmt = $pdo->prepare('INSERT INTO inscription(utilisateur_id, evenement_id) 
                        VALUES (:utilisateur_id, :evenement_id)');
           
            $stmt->bindParam(':utilisateur_id',$utilisateur_id);
            $stmt->bindParam(':evenement_id',$evenement_id);
            $stmt->execute();
            return $pdo->lastInsertId();

        }


    } catch (PDOException $e) {
        echo 'Erreur '.$e->getMessage().' Code '.$e->getCode();
        return null;
    }
}

function findOneInscription($pdo,$utilisateur_id,$evenement_id){
    $stmt = $pdo->prepare('SELECT * from inscription 
            where utilisateur_id = :utilisateur_id and  evenement_id = :evenement_id');
    $stmt->bindParam(':utilisateur_id',$utilisateur_id);
    $stmt->bindParam(':evenement_id',$evenement_id);
    $stmt->execute();
    $inscription = $stmt->fetch();
    if ($inscription) {
        return $inscription;
    }
        return null;

}

function deleteInscription($pdo,$utilisateur_id,$evenement_id){
    $stmt = $pdo->prepare('DELETE from inscription
            where utilisateur_id = :utilisateur_id and  evenement_id = :evenement_id');
    $stmt->bindParam(':utilisateur_id',$utilisateur_id);
    $stmt->bindParam(':evenement_id',$evenement_id);
    $stmt->execute();
}

?>