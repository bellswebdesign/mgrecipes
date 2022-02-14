<?php require_once('app/initialize.php');

$ajax = new Ajax();

if ($ajax->is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) {
        $action = $_POST["action"];
        switch ($action) {
            case "addIngredient":
                $ajax->addIngredient();
                break;
            case "deleteIngredient":
                $ajax->deleteIngredient();
                break;
            case "addDirection":
                $ajax->addDirection();
                break;
            case "deleteDirection":
                $ajax->deleteDirection();
                break;
            case "deleteRecipe":
                $ajax->deleteRecipe();
                break;
            case "editRecipe":
                $ajax->updateRecipe();
                break;
            case "searchRecipes":
                $ajax->searchRecipes();
                break;
        }
    }
}

?>