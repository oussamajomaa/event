<?php
class User {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($nom, $email, $password, $token) {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO utilisateur(nom, email, password, role, token) 
                    VALUES (:nom, :email, :password, :role, :token)');
            $role = 'utilisateur';
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $id = $this->pdo->lastInsertId();
            if ($id) {
                echo $id;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage() . ' Code: ' . $e->getCode();
            return null;
        }
    }

    public function login($email, $password) {
        try {
            $stmt = $this->pdo->prepare('SELECT * from utilisateur where email = :email');
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                if (!$user['is_active']){
                    ?>
                        <div class="py-3 rounded bg-yellow-300 text-center flex justify-between px-6">
                            <h2>Activez votre compte!!!</h2>
                            <button class="btn btn-circle btn-outline btn-sm" onclick="this.parentElement.style.display='none';">X</button>
                        </div>
                    <?php
                    return null;
                }elseif (password_verify($password,$user['password'])){
                    return $user;
                }else {
                    ?>
                        <div class="py-3 rounded bg-yellow-300 text-center flex justify-between px-6">
                            <h2>Mot de passe incorrect !!!</h2>
                            <button class="btn btn-circle btn-outline btn-sm" onclick="this.parentElement.style.display='none';">X</button>
                        </div>
                    <?php
                    return null;
                }
            } else {
                ?>
                    <div class="py-3 rounded bg-yellow-300 text-center flex justify-between px-6">
                        <h2>Utilisateur non trouvé !!!</h2>
                        <button class="btn btn-circle btn-outline btn-sm" onclick="this.parentElement.style.display='none';">X</button>
                    </div>
                <?php
                return null;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage() . ' Code: ' . $e->getCode();
            return null;
        }
    }

    public function activeUser($email,$token) {
        try {
            $stmt = $this->pdo->prepare('SELECT * from utilisateur where email = :email and token=:token');
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':token',$token);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                $stmt = $this->pdo->prepare('UPDATE utilisateur SET is_active=1 where email=:email');
                $stmt->bindParam(':email',$email);
                $stmt->execute();
                echo "Votre compte a été validé avec succès !";
            } else {
                echo "Lien de validation invalide ou compte déjà activé.";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage() . ' Code: ' . $e->getCode();
            return null;
        }
    }
}

?>