<?php

final class Singleton {
    private static $instance = null;

    private function __construct() {
        // Empêche l'instanciation directe
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
}



class Event {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getEvent() {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM evenement');
            $stmt->execute();
            $evenements = $stmt->fetchAll();
            return $evenements;
        } catch (PDOException $e){
            echo 'Error: ' . $e->getMessage() . $e->getCode();
            return null;
        }
    }

    public function getOneEvent($id){
        try {
            $stmt = $this->pdo->prepare('SELECT *,lieu.nom as lieu_nom, organisateur.nom as  organisateur_nom  FROM evenement
                                        INNER JOIN organisateur on evenement.organisateur_id = organisateur.id
                                        INNER JOIN lieu on evenement.lieu_id = lieu.id
                                        where evenement.id = :id');
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $evenement = $stmt->fetch();
            if ($evenement) {
                return $evenement;
            } else {
                echo "<p>Événement non trouvé.</p>";
            }

        } catch (PDOException $e){
            echo 'Error: ' . $e->getMessage() . $e->getCode();
            return null;
        }
    }

    public function getNombrePlace($id){
        try {
            $stmt = $this->pdo->prepare('SELECT COUNT(*) as total FROM evenement
                                        INNER JOIN inscription on evenement.id = inscription.evenement_id
                                        where evenement.id = :id');
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $inscription = $stmt->fetch();
            $total = $inscription['total'];
            if ($total) {
                return $total;
            } else {
                echo "<p>Événement non trouvé.</p>";
            }

        } catch (PDOException $e){
            echo 'Error: ' . $e->getMessage() . $e->getCode();
            return null;
        }
    }

    public function checkInscription($eventId,$userId){
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM inscription
                        where inscription.evenement_id = :eventId and inscription.utilisateur_id = :userId');
            $stmt->bindParam(':eventId',$eventId);
            $stmt->bindParam(':userId',$userId);
            $stmt->execute();
            $suscribed = $stmt->fetch();
            if ($suscribed) {
                return $suscribed;
            } else {
                return null;
            }

        } catch (PDOException $e){
            echo 'Error: ' . $e->getMessage() . $e->getCode();
            return null;
        }
        
    }
}

?>