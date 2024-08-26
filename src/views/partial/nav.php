<?php
session_start();
?>

<nav class=" p-3 flex gap-6 items-center bg-slate-300">
    <a href="?page=home"><img src="public/images/logo_event.svg" class="w-16" alt="logo_event.svg"></a>
    <ul class="flex gap-10 items-center w-3/4">
        <li><a href="?page=home">Événements</a></li>
        <li><a href="?page=about">About</a></li>
        <li><a href="?page=contact">Contact</a></li>
        <?php
        if ($_SESSION['role'] == 'administrateur') {
            echo "<li><a  class='btn btn-md'>Page admin</a></li>";
        } else {
            echo "<li><a href='?page=login' class='btn btn-md'>Page admin</a></li>";
        }
        ?>

    </ul>
        <?php
        if ($_SESSION['nom']) {
        ?>
        <div class="ml-auto flex items-center gap-3">
            <h2 class="">Bonjour <?=$_SESSION['nom'];?></h2>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost rounded-btn"><img src="public/images/user.svg" alt=""></div>
                <ul tabindex="0" class="menu dropdown-content bg-base-100 rounded-box z-[1] mt-4 w-52 p-2 shadow">
                    <li><a href='?page=logout' class=''>Déconnexion</a></li>
                </ul>
            </div>
        </div>
            
        <?php
        } else {
        ?>
            <div class="dropdown dropdown-end ml-auto">
                <div tabindex="0" role="button" class="btn btn-ghost rounded-btn"><img src="public/images/user.svg" alt=""></div>
                <ul tabindex="0" class="menu dropdown-content bg-base-100 rounded-box z-[1] mt-4 w-52 p-2 shadow">
                    <li><a href='?page=login' class=''>Connexion</a></li>
                </ul>
            </div>
        <?php
        }
        ?>
</nav>