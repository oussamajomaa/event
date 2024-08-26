<?php
require_once __DIR__ . '/../models/evenement.php';
require_once __DIR__ . '/../models/db_connection.php';
require_once __DIR__ . '/../controllers/Event.php';

// $evenements = getEvent($pdo);
$event = new Event($pdo);
$evenements = $event->getEvent();

echo "<div class='flex gap-6 flex-wrap justify-between'>";

foreach ($evenements as $evenement) {
?>
    <div class='p-3 mb-6 w-[400px] shadow-xl flex flex-col gap-2 '>
        <h2 class='text-xl font-bold'><?= $evenement['nom'] ?></h2>
        <p><?= $evenement['description'] ?></p>
        <p><?= $evenement['date'] ?></p>
        
        <a href="?page=evenement_detail&id=<?= $evenement['id'] ?>" class="btn btn-primary btn-sm w-20 place-self-end mt-auto">Détail</a>
    </div>
<?php
}
echo "</div>";
?>