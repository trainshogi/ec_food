<?php


require_once('dbconnect.php');

$stmt = $dbh->prepare('INSERT INTO dises (dish_name) VALUES (?)');
$stmt->execute([test]);//
$stmt = $dbh->prepare('SELECT
ingredient_name
FROM
ingredients
JOIN
ingredients_to_dishes
ON
ingredients.ingredient_id = ingredients_to_dishes.ingredient_id
JOIN
dishes
ON
ingredients_to_dishes.dish_id = dishes.dish_id
WHERE
dishes.dish_name = (?)');
$stmt->execute([$dish_name]);//?を変数に置き換えてSQLを実行

?>