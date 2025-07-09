<?php
if (! defined('ACCESS_ALLOWED')) {
	header('Location: ../');
	die;
};



?>

<header class="wrapper">
    <nav>
        <div class="logo"><a href="<?= PATH  ?>">TP-Recettes</a></div>
        <div class="menus">
            <ul>
                <li><a href="<?= PATH ?>index.php?act=create"><button class="button-primary">Ajouter une recette</button></a></li>
            </ul>
        </div>
    </nav>
</header>