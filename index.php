<?php

// ---------------------------------------- //
//             ERRORS DISPLAY               //
// ---------------------------------------- //
// A enlever lors du déploiement
error_reporting(E_ALL);
ini_set('display_errors', true);

// ---------------------------------------- //
//                SESSIONS                  //
// ---------------------------------------- //
ini_set('session.cookie_lifetime', false);
session_start();

// ---------------------------------------- //
//           Definir les PATH               //
// ---------------------------------------- //
define("PATH_REQUIRE", substr($_SERVER['SCRIPT_FILENAME'], 0, -9)); // Pour les fonctions d'inclusion php
define("PATH", substr($_SERVER['PHP_SELF'], 0, -9)); // Pour les images, fichiers etc (html)

// ---------------------------------------- //
//       Securiser tous les fichiers        //
// ---------------------------------------- //
define('ACCESS_ALLOWED', true);

// ---------------------------------------- //
//            INCLURE CONFIG.PHP            //
// ---------------------------------------- //
require_once PATH_REQUIRE."config/config.php";

// ---------------------------------------- //
//         PDO: CONNEXION A LA BDD          //
// ---------------------------------------- //
require_once PATH_REQUIRE."Classes/Db_Driver.php";

// ---------------------------------------- //
//            INCLURE FUNCTIONS.PHP            //
// ---------------------------------------- //
require_once PATH_REQUIRE."Classes/Functions.php";
$func = new Func();

// ---------------------------------------- //
//     INCLURE LE HEAD ET LE HEADER         //
// ---------------------------------------- //
require_once PATH_REQUIRE."includes/head.inc.php";
require_once PATH_REQUIRE."includes/header.inc.php";

// ---------------------------------------- //
//      Définition de la page courante      //
// ---------------------------------------- //
if ( isset($_GET['act']) AND !empty($_GET['act']) ) {
    $action = trim(strtolower($_GET['act']));
} else {
    $action = "read_list";
}

// ---------------------------------------- //
//     Array contenant toutes les pages     //
// ---------------------------------------- //
$allPages = scandir(PATH_REQUIRE."sources/");

// ---------------------------------------- //
//  Vérification de l'existence de la page  //
// ---------------------------------------- //
if( in_array( $action.".php", $allPages) ) {
    // Une sécurité en plus pour les petits malins !
    if( $action.".php" === "index.php") {
        header('Location: ./');
	    die;
    }
    // INCLUSION DE LA PAGE
    require_once PATH_REQUIRE."sources/".$action.".php";
} else {
    // SINON RETOURNE LA PAGE 404 !
    require_once PATH_REQUIRE."sources/404.php";
}

// ---------------------------------------- //
//          INCLURE LE FOOTER               //
// ---------------------------------------- //
// require_once PATH_REQUIRE."includes/footer.inc.php";