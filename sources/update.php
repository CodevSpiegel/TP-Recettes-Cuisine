<?php

if (! defined('ACCESS_ALLOWED')) {
	header('Location: ../');
	die;
};

// A venir !

?>

<main class="wrapper">
    <section class="section">
        <h1>Modifier une Recette</h1>
    </section>

    <section class="section">
        <div>
            <form action="" method="post">
                <label for="name">Nom</label>
                <input type="text" name="name" />
            </form>
        </div>
        <a href="<?= PATH ?>"><button class="button-secondary">Annuler</button></a>
    </section>

</main>