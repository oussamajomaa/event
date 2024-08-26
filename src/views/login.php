<?php
    session_start();
    require_once __DIR__ . '/../models/db_connection.php';
    require_once __DIR__ . '/../controllers/User.php';
    $user = new User($pdo);
    if (isset($_POST['email']) && isset($_POST['password'])) {
        
        $utilisateur = $user->login($_POST['email'],$_POST['password']);
        if ($utilisateur) {
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['id'] = $utilisateur['id'];
            $_SESSION['role'] = $utilisateur['role'];
            if ($utilisateur['role']=='administrateur' ){
                header('Location:?page=admin');
            } else {
                header('Location:?page=home');
            }
        } 
        // else {
        //     echo "<p class='alert alert-warning'>Utilisateur non trouvé ou identifiants incorrect</p>";
        // }

    }
    ?>
    <div class="flex justify-center items-center h-[calc(100vh-340px)]">
        <div class="shadow-xl p-5 rounded w-[400px] flex flex-col">
            <h2 class="text-center text-3xl font-bold mb-3">Se connecter</h2>
            <form method="post" class="flex flex-col gap-4">
                <input required type="text" name="email" placeholder="email" class="input input-bordered w-full" />
                <input required type="password" name="password" placeholder="password" class="input input-bordered w-full" />
                <button class="btn bg-blue-600 btn-primary mb-3" type="submit">Se connecter</button>
            </form>
            <a href="?page=register" class="ml-auto text-blue-600">S'inscrire</a>
            <?php if (isset($_GET['error'])) : ?>
                <p class="text-red-600">Nom d'utilisateur ou mot de passe incorrect.</p>
            <?php endif; ?>
        </div>
    </div>