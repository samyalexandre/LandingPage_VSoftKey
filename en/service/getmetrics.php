#!/usr/bin/php
<?php

define("SERVER","localhost");
define("USER","root");
define("PASSWD","Hepto-Gamif-17");
define("DB_NAME", "cm");
define("PORT", "3306");
define("PDO_DSN","mysql:host=" . SERVER . ";port=" . PORT . ";dbname=" . DB_NAME);


//Nombre likes facebook Heptaward
$nb_likes_h7 = file_get_contents('https://api.facebook.com/method/fql.query?query=select%20like_count%20from%20link_stat%20where%20url=%27https://www.facebook.com/heptaward/%27&format=json');
    $nb_likes_h7 = json_decode($nb_likes_h7, true);

//Nombre likes facebook Web et So
$nb_likes_ws = file_get_contents('https://api.facebook.com/method/fql.query?query=select%20like_count%20from%20link_stat%20where%20url=%27https://www.facebook.com/Web-et-Solutions-170017249686260/%27&format=json');
    $nb_likes_ws = json_decode($nb_likes_ws, true);

//Nombre followers Twitter Heptaward
$nb_followers_h7 = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=heptaward');
    $nb_followers_h7 = json_decode($nb_followers_h7, true);

//Nombre followers Twitter Web et So
$nb_followers_ws = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=WebetSolutions');
    $nb_followers_ws = json_decode($nb_followers_ws, true);

$connexion = new PDO(PDO_DSN, USER, PASSWD);

$connexion->exec("set names utf8");

$query = "INSERT INTO facebook (name, likes) VALUES ('Heptaward', " . $nb_likes_h7[0]['like_count'] . ")" ;
$statement=$connexion->prepare($query);
$statement->execute();

$query = "INSERT INTO facebook (name, likes) VALUES ('Web & Solutions', " . $nb_likes_ws[0]['like_count'] . ")" ;
$statement=$connexion->prepare($query);
$statement->execute();

$query = "INSERT INTO twitter (name, followers) VALUES ('Heptaward', " . $nb_followers_h7[0]['followers_count'] . ")";
$statement=$connexion->prepare($query);
$statement->execute();

$query = "INSERT INTO twitter (name, followers) VALUES ('Web & Solutions', " . $nb_followers_ws[0]['followers_count'] . ")";
$statement=$connexion->prepare($query);
$statement->execute();

?>
