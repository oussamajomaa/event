<?php
    session_start();
    require_once __DIR__ . '/../controllers/Event.php';
    require_once __DIR__ . '/../models/db_connection.php';
    require_once __DIR__ . '/../controllers/Inscription.php';

    $event = new Event($pdo);
    
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Assurez-vous que l'ID est un entier
        $evenement = $event->getOneEvent($id);
        $inscription = $event->getNombrePlace($id);
        $subscribed = $event->checkInscription($id, $_SESSION['id']);
        
        $placeRestante = $evenement['place'] - $inscription;
        if ($evenement) {
            // Affichez les détails de l'événement
            ?>

        <div class="flex gap-5">
            
            <div class="w-1/2 ">
                <img src="<?=$evenement['cover'] ?>" class="w-full" alt="">
            </div>
            <div class="bg-slate-200 w-1/2 p-5 flex flex-col gap-5">

                <h2 class='text-xl font-bold'><?=$evenement['nom'] ?></h2>
                <p><span class="font-bold">Description:</span> <?=$evenement['description'] ?></p>
                <p><span class="font-bold">Date:</span> <?=$evenement['date'] ?></p>
                <p><span class="font-bold">Lieu:</span> <?=$evenement['lieu_nom'] ?></p>
                <p><span class="font-bold">Adresse:</span> <?=$evenement['adresse'] ?></p>
                <p><span class="font-bold">Organisateur: </span> <?=$evenement['organisateur_nom'] ?></p>
                <p><span class="font-bold">Nombre de place restantes: </span><?= $placeRestante ?>
                
                    
                <?php 
                    if ($_SESSION['nom']){
                        if ($subscribed) {
                            echo "<div class='flex gap-6'>";
                            echo "<span class='badge badge-primary p-4'>Vous êtes inscrit</span>";
                            echo "<a href='?page=desinscription_handler&id=$id' class='badge bg-red-300 p-4'>Se désinscrire</a>";
                            echo "</div>";
                        } else {
                            ?>
                            <div><a href="?page=inscription_handler&id=<?=$id ?>" class='badge badge-warning p-4'>S'inscrire à l'événement</a></div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="py-6 rounded bg-yellow-300 text-center flex justify-between px-6">
                            <h2>Connectez-vous afin de vous inscrire à un événement</h2>
                            <button class="btn btn-circle btn-outline btn-sm" onclick="this.parentElement.style.display='none';">X</button>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
        } else {
            echo "<p>Événement non trouvé.</p>";
        }
    } else {
        echo "<p>ID de l'événement non spécifié.</p>";
    }
?>