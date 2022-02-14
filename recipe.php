<?php require_once('app/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to('all-recipes.php');
} else {
    $id = $_GET['id'];
}

$recipe = new Recipe();
$ingredients = new Ingredient();
$directions = new Direction();
$recipeDetails = $recipe->getRecipeId($id);

$pageTitle = $recipeDetails['name'];

include('app/includes/layout/header.php');
include('app/includes/layout/banner.php');

?>


    <section class="single-recipe recipe <?= slugify($recipeDetails['name']);?>" itemscope itemtype="http://schema.org/Recipe">

        <div class="container">

            <div class="row recipe-details-wrapper">

                <div class="col-md-10 offset-md-1 recipe-details <?= slugify($recipeDetails['name']);?>-details">

                    <div class="row">

                        <div class="col-md-8 recipe-description">
                            <h1 class="recipe-name" itemprop="name"><?= $recipeDetails['name']; ?></h1>

                            <div class="recipe-description-content" itemprop="description">

                                <?= $recipeDetails['description']; ?>

                            </div>

                            <ul class="ingredient-list">
                                <?php
                                $ingredientNum = 1;
                                foreach ($ingredients->getRecipeIngredients($recipeDetails['id']) as $ingredient):
                                    ?>

                                    <li class="ingredient-item" itemprop="recipeIngredient"><?= $ingredient['measure_amount'] . ' ' . ($ingredients->getMeasurementTypeById($ingredient['measurement_type_id']) != "none" ? ($ingredient['measure_amount'] > '1' ? strtolower($ingredients->getMeasurementTypeById($ingredient['measurement_type_id'])) . "s of " : strtolower($ingredients->getMeasurementTypeById($ingredient['measurement_type_id']))):'') . ' ' . $ingredient['ingredient_name']; ?>    </li>

                                    <?php $ingredientNum++; endforeach; ?>
                            </ul>

                        </div>

                        <div class="col-md-4 recipe-image">
                            <img src="assets/img/_default_img.png" alt="" width="" height="" border="0"/>
                        </div>

                    </div>

                    <div class="row recipe-directions-wrapper">

                        <div class="recipe recipe-directions <?= slugify($recipeDetails['name']);?>-directions">
                            <ol class="directions-list" itemprop="recipeInstructions">
                                <?php
                                $directionNum = 1;
                                foreach ($directions->getRecipeDirections($recipeDetails['id']) as $direction): ?>
                                    <li class="direction-item"><?= $direction['instruction']; ?>    </li>
                                    <?php $directionNum++; endforeach; ?>
                            </ol>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

<?php include('app/includes/layout/footer.php'); ?>