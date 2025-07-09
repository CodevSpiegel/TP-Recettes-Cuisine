<?php

try {
    $bdd = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
}