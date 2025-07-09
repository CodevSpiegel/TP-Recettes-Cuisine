<?php

if (! defined('ACCESS_ALLOWED')) {
	header('Location: ../');
	die;
};

?>

<main class="wrapper">
    <section class="section">
        <h1>Supprimer une Recette</h1>
    </section>

    <section class="section">
        <div>
            <div>FORM</div>
        </div>
        <a href="<?= PATH ?>"><button class="button-secondary">Annuler</button></a>
    </section>

</main>