<?php

if (! defined('ACCESS_ALLOWED')) {
	header('Location: ../');
	die;
};

if ( !isset($_GET['id']) OR empty($_GET['id']) OR trim($_GET['id']) == "" ) {
    header('Location: ./');
	die;
} else {
    $id = trim(htmlspecialchars($_GET['id']));
}

    // SELECT m.name, m.id, m.posts, m.joined, m.mgroup, m.email,m.title, m.hide_email, m.location, m.aim_name, m.icq_number,
    //                        me.photo_location, me.photo_type, me.photo_dimensions
    //                 FROM ibf_members m
    //                   LEFT JOIN ibf_member_extra me ON me.id=m.id
    //                   LEFT JOIN ibf_groups g ON m.mgroup=g.g_id
    //                 WHERE m.id > 0".$q_extra." AND g.g_hide_from_list <> 1
    //                 ORDER BY m.".$this->sort_key." ".$this->sort_order."
    //                 LIMIT ".$this->first.",".$this->max_results


// $sql = "SELECT * FROM recipes 
//             JOIN ingredients_recipes 
//             WHERE recipes.id = ingredients_recipes.recipe_id
//             AND difficulty = :difficulty 
//             GROUP BY recipes.id ORDER BY name";

$sql = "SELECT id, name, description, duration, difficulty
        FROM recipes
        WHERE id = :id";

$req = $bdd->prepare($sql);
$req->bindParam(":id", $id, PDO::PARAM_INT);
$req->execute();
$recipe = $req->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif

if(!$recipe) {
    header('Location: ./index.php?act=404');
	die;
} else {
    $sql = "SELECT i.id, i.name, ir.ingredient_id, ir.quantity, ir.unity
            FROM ingredients AS i
            JOIN ingredients_recipes AS ir ON i.id = ir.ingredient_id
            WHERE ir.recipe_id = ".$recipe['id'];

    $req = $bdd->prepare($sql);
    $req->execute();
    $ingredients = $req->fetchAll(PDO::FETCH_ASSOC);
}


?>


<main class="wrapper">
    <section class="section">
        <h1><?= $recipe['name'] ?></h1>
    </section>

    <section class="section">
        <div>
            <div>Description : <?= $recipe['description'] ?></div>
            <div>Durée : <?= $recipe['duration'] ?></div>
            <div>Difficulté : <?= $recipe['difficulty'] ?></div>
            <div>
                Liste des ingredients :
                <ul>
<?php foreach ($ingredients as $ingredient):

$quantity = ceil($ingredient['quantity']);

$unity = $func->convert_unity($ingredient['unity']);

?>
                    <li><?= $quantity." ".$unity . $ingredient['name'] ?></li>
<?php endforeach; ?>
                </ul>
            </div>
        </div>
        <a href="<?= PATH ?>"><button class="button-secondary">Retour</button></a>
    </section>

</main>