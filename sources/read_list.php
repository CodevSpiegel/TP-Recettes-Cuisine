<?php

if (! defined('ACCESS_ALLOWED')) {
	header('Location: ../');
	die;
};

$class_button_0 = "button-secondary";
$class_button_1 = "button-secondary";
$class_button_2 = "button-secondary";
$class_button_3 = "button-secondary";


if ( !isset($_POST['list']) || $_POST['list'] === "all") {

    $sql = "SELECT * FROM recipes ORDER BY difficulty, name";

    $req = $bdd->prepare($sql);
    $req->execute();

    $class_button_0 = "button-primary";

}
else {
    $difficulty = $_POST['list'];
    switch ($difficulty) {
        case 'facile':
            $class_button_1 = "button-primary";
            break;
        case 'normale':
            $class_button_2 = "button-primary";
            break;
        case 'difficile':
            $class_button_3 = "button-primary";
            break;
        default:
            # code...
            break;
    }

    $sql = "SELECT * FROM recipes
            WHERE difficulty = :difficulty 
            ORDER BY difficulty, name";

    $req = $bdd->prepare($sql);
    $req->bindParam(":difficulty", $difficulty, PDO::PARAM_STR);
    $req->execute();
}


$recipes = $req->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau associatif
$nb = count($recipes);

?>


<main class="wrapper">
    <section class="section">
        <h1>Liste des recettes (<?= $nb ?>)</h1>
        <div class="form-buttons">
            <form action="<?= PATH ?>" method="post">
                <input type="hidden" name="list" value="all">
                <button class="<?= $class_button_0 ?>">Toutes</button>
            </form>
            <form action="<?= PATH ?>" method="post">
                <input type="hidden" name="list" value="facile">
                <button class="<?= $class_button_1 ?>">Faciles</button>
            </form>
            <form action="<?= PATH ?>" method="post">
                <input type="hidden" name="list" value="normale">
                <button class="<?= $class_button_2 ?>">Normales</button>
            </form>
            <form action="<?= PATH ?>" method="post">
                <input type="hidden" name="list" value="difficile">
                <button class="<?= $class_button_3 ?>">Difficiles</button>
            </form>
        </div>
<?php foreach ($recipes as $recipe): ?>
        <div class="list-row">
            <h4><?= $recipe['name'] ?></h4>
            <p><?= $recipe['difficulty'] ?></p>
            <div><a href="<?= PATH ?>index.php?act=read&id=<?= $recipe['id'] ?>"><button class="button-secondary">Voir</button></a></div>
            <div><a href="<?= PATH ?>index.php?act=update&id=<?= $recipe['id'] ?>"><button class="button-secondary">Modifier</button></a></div>
            <div><a href="<?= PATH ?>index.php?act=delete&id=<?= $recipe['id'] ?>"><button class="button-secondary">Supprimer</button></a></div>
        </div>
<?php endforeach; ?>
</section>
</main>