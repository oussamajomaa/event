<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../models/db_connection.php';
require_once __DIR__ . '/../controllers/User.php';
$user = new User($pdo);

if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50));  // Génère un token unique
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $result = $user->register($_POST['nom'], $email, $password, $token);
    

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Serveur SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'osmjom@gmail.com';  // Remplacez par votre adresse Gmail
            $mail->Password = 'mlfzhpeqbdxzpkcm';  // Remplacez par votre mot de passe d'application Gmail
            $mail->SMTPSecure = 'tls';  // 'tls' pour le port 587, 'ssl' pour le port 465
            $mail->Port = 587;  // Utilisez 587 pour TLS, 465 pour SSL

            // Définir le sujet et le corps de l'email
            $subject = "Validez votre inscription";
            $message = "Cliquez sur ce lien pour valider votre compte : ";
            $message .= "http://localhost/event/?page=validate&email=$email&token=$token";

            // Paramètres de l'email
            $mail->setFrom('osmjom@gmail.com', 'OUSSAMA');
            $mail->addAddress($email);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

   

            // Envoyer l'email
            $mail->send();
            echo 'L\'email de validation a été envoyé';
        } catch (Exception $e) {
            echo "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }
        ?>
        
        <?php
        header('Location:?page=login');
        exit();
    
}
?>
<div class="flex justify-center items-center h-[calc(100vh-340px)]">
    <div class="shadow-xl p-5 rounded w-[400px] flex flex-col">
        <h2 class="text-center text-3xl font-bold mb-3">S'inscrire</h2>
        <form method="post" class="flex flex-col gap-4">
            <input required type="text" name="nom" placeholder="nom" class="input input-bordered w-full" />
            <input required type="text" name="email" placeholder="email" class="input input-bordered w-full" />
            <input required type="password" name="password" placeholder="password" class="input input-bordered w-full" />
            <button class="btn bg-blue-600 btn-primary mb-3" type="submit">Se connecter</button>
        </form>
        
        <?php if (isset($_GET['error'])) : ?>
            <p class="text-red-600">Nom d'utilisateur ou mot de passe incorrect.</p>
        <?php endif; ?>
    </div>
</div>

