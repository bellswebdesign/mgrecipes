<?php require_once('app/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to('all-recipes.php');
} else {
    $id = $_GET['id'];
    $ingredent = new Ingredient();
    $ingredent->processAddIngredient();
}

?>