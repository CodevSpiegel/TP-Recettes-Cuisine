<?php

if (! defined('ACCESS_ALLOWED')) {
	header('Location: ../');
	die;
};

// Default values
$name = "";
$description = "";
$duration = "";
$difficulty_checked_1 = "";
$difficulty_checked_2 = "";
$difficulty_checked_3 = "";

$error = false;
$message = "";


if ( isset($_POST['valid_button']) ) {

    $name = $func->secur_string($_POST['name']);
    $description = $func->secur_string($_POST['description']);

    $duration = $func->secur_string($_POST['duration']);
    $duration = filter_var($duration, FILTER_VALIDATE_INT); // 65000 || false

    $availableDifficulty = ["facile", "normale", "difficile"];
    $difficulty = in_array($_POST['difficulty'], $availableDifficulty) ? $_POST['difficulty'] : false;


    if ($_POST['difficulty'] === "facile") {
        $difficulty_checked_1 = "checked ";
    }
    elseif ($_POST['difficulty'] === "normale") {
        $difficulty_checked_2 = "checked ";
    }
    else {
        $difficulty_checked_3 = "checked ";
    }


    if( !$name ) {
        $error = true;
        $message = "<div class=\"error\">Vous devez saisir un nom de Recette !</div>\n";
    }
    elseif ( !$description ) {
        $error = true;
        $message = "<div class=\"error\">Vous devez saisir une description !</div>\n";
    }
    elseif ( !$duration ) {
        $error = true;
        $message = "<div class=\"error\">Vous devez indiquer une durée !</div>\n";
    }
    elseif(!isset($_POST['difficulty'])) {
        header('Location: ../');
	    die;
    }
    else {
        // Verifier que le nom du Nouveau SET n'existe pas déjà !
        $sql = "SELECT name FROM recipes WHERE name = :name";
        $req = $bdd->prepare($sql);
        $req->bindParam(":name", $name, PDO::PARAM_STR);
        $req->execute();
        $recipes = $req->fetch(PDO::FETCH_ASSOC);

        if ($recipes) {
            // Le nom de recette existe déjà !
            $error = true;
            $message = "<div class=\"error\">La Recette <b>$name</b> existe déjà !</div>\n";
        }
        else {
            // Sinon inserer le Nouveau SET dans la BDD
            $sql = "INSERT INTO `recipes` ( `name`, `description`, `duration`, `difficulty`) 
            VALUES ( :name, :description, :duration, :difficulty);";
            $req = $bdd->prepare($sql);
            $req->bindParam(":name", $name, PDO::PARAM_STR);
            $req->bindParam(":description", $description, PDO::PARAM_STR);
            $req->bindParam(":duration", $duration, PDO::PARAM_INT);
            $req->bindParam(":difficulty", $difficulty, PDO::PARAM_STR);
            $req->execute();

            $lastInsertId = $bdd->lastInsertId();
            // if($lastInsertId) {
            //     header("Location: ../index.php?message=success&id=$lastInsertId");
            // }
            // else {
            //     header("Location: ../index.php?message=erreur");
            // }

            $message = "<div class=\"succes\">(ID = $lastInsertId) Le Set <b>$name</b> a été crée avec succes !</div>";
        }
    }

    if ($error) {

    }
}


?>

<main class="wrapper">
    <section class="section">
        <h1>Ajouter une Recette</h1>
    </section>

    <section class="section">
        <div>
            <form action="<?= PATH ?>index.php?act=create" method="post">
                <?= $message ?>
                <div>
                    <label for="name">Nom de la recette :</label>
                    <input type="text" id="name" name="name" value="<?= $name ?>" required />
                </div>
                <div>
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" required><?= $description ?></textarea>
                </div>
                <div>
                    <label for="duration">Durée :</label>
                    <input type="text" id="duration" name="duration" value="<?= $duration ?>" required />
                </div>
                <div>
                    <fieldset>
                        <legend>Difficulté de la recette</legend>
                        <label for="facile">Facile</label>
                        <input type="radio" id="facile" name="difficulty" value="facile" <?= $difficulty_checked_1 ?>/>
                        <label for="non">Normale</label>
                        <input type="radio" id="normale" name="difficulty" value="normale" <?= $difficulty_checked_2 ?>/>
                        <label for="non">Difficile</label>
                        <input type="radio" id="difficile" name="difficulty" value="difficile" <?= $difficulty_checked_3 ?>/>
                    </fieldset>
                </div>
                <button class="button-secondary" name="valid_button">Ajouter</button>
            </form>
        </div>
    </section>
</main>