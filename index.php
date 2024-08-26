<?php
require 'vendor/autoload.php';
include 'src/views/partial/header.php';
$BASE_URL = 'src/views/';

// Détermine la page à afficher
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$pageFile = $BASE_URL . $page . '.php';
?>
<div class="p-5 ">
    <?php
        // Vérifie si le fichier existe
        if (file_exists($pageFile)) {
            include $pageFile;
        } else {
            http_response_code(404);
            echo '<h1>404 Not Found</h1><p>The page you are looking for does not exist.</p>';
        }
    ?>
</div>
<?php
include 'src/views/partial/footer.php';
?>


