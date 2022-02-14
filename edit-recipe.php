<?php require_once('app/initialize.php');

$recipe = new Recipe();
$ingredients = new Ingredient();
$directions = new Direction();

$pageTitle = 'Edit Recipe';

if (!isset($_GET['id'])) {
    redirect_to('all-recipes.php');
} else {
    $id = $_GET['id'];
}

$recipeDetails = $recipe->getRecipeId($id);


if (isset($_POST["submit"])) {
    $formData = $_POST["recipe"];
    $editRecipe = new Edit();
    $editRecipe->processEditRecipe();
}

include('app/includes/layout/header.php');

?>

    <form class="<?= pageSlug($pageTitle); ?> edit-<?= slugify($recipeDetails['name']); ?>" action="" method="post">

        <input type="hidden" name='recipe[id]' value="<?= $id; ?>">
        <input type="hidden" name='recipe[action]' value="editRecipe">

        <section class="jumbotron">

            <div class="container">

                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h1 class="page-title underline text-center"><?= $pageTitle; ?></h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="input-group">
                            <input type="text" class="form-control add-title" placeholder="Title" value="<?= $recipeDetails['name']; ?>" name='recipe[name]'>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <div class="container">

            <section class="row recipe-description-container">

                <div class="col-md-10 offset-md-1">
                    <h2 class="description-title">Description
                        <span class="glyphicon glyphicon-question-sign" style="color: #f57e20;"></span>
                    </h2>
                    <textarea placeholder="Text input" class="form-control add-descr" rows="5" name="recipe[description]"><?= $recipeDetails['description']; ?></textarea>
                </div>

            </section>

            <section class="row recipe-ingredient-container">

                <div class="col-md-10 offset-md-1">
                    <h2 class="ingredient-title">Ingredients <i class="fas fa-question-circle"></i></h2>

                    <div class="row serving-size-container">

                        <div class="col-xs-12 col-sm-4 offset-md-8 serving-size">
                            <h3>Serving Size</h3>
                            <input type="number" min="1"  class="form-control" required placeholder="4" value="<?= $recipeDetails['serving_size']; ?>" name="recipe[serving_size]">
                        </div>

                    </div>

                </div>

                <div class="col-12 ingredient-list-container">

                    <div class="row">

                        <div class="col-md-10 offset-md-1">
                            <table class="table table-striped table-responsive table-ingredients">

                                <thead>
                                    <tr>
                                        <th class="measurement-amount">Amount</th>
                                        <th class="measurement-type-list">Measure</th>
                                        <th class="ingredient-item">Ingredient</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <?php
                                $ingredientNum = 1;
                                foreach ($ingredients->getRecipeIngredients($id) as $ingredient):

                                    ?>

                                    <tr class="individual-ingredient" id="<?= $ingredient['ingredient_id'];?>">

                                        <td class="measurement-amount">
                                            <input type="number" required value="<?= $ingredient['measure_amount']; ?>" class="form-control" name="recipe[measurement_amount_<?= $ingredientNum; ?>]">
                                        </td>

                                        <td class="measurement-type-list">

                                            <select class="form-control" id="measurement-types" name="recipe[measurement_type_<?= $ingredientNum; ?>]">
                                                <option value="" disabled selected>Please select...</option>
                                                <?php foreach ($ingredients->getMeasurementTypes() as $measurementType): ?>
                                                    <option <?php if (isset($ingredient)){ if ($measurementType['measurement_type'] == $ingredients->getMeasurementTypeById($ingredient['measurement_type_id'])) echo 'selected';} ?>><?= $measurementType['measurement_type']; ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                        </td>
                                        <td class="ingredient-item">
                                            <input type="" class="form-control"
                                                   value="<?= $ingredient['ingredient_name']; ?>"

                                                   name="recipe[ingredient_name_<?= $ingredientNum; ?>]">
                                        </td>
                                        <td class="ingredient-delete">
                                            <a class="delete-ingredient-btn">
                                                <i class="fas fa-times-circle"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php $ingredientNum++; endforeach; ?>

                            </table>

                            <span class="add-ingredient-btn">+ADD ANOTHER</span>

                        </div>

                    </div>

                </div>

            </section>

            <section class="row recipe-directions-container">

                <div class="col-md-10 offset-md-1">
                    <h2 class="directions-title">Directions <span class="fas fa-question-circle"></span></h2>

                    <div class="row prep-cook-times">
                        <div class="col-xs-12 col-sm-4 offset-md-4 prep-cook-time prep-time">
                            <h3>Prep</h3>
                            <input type="number" class="form-control" placeholder="20" name="recipe[prep_time]" value="<?= $recipeDetails['prep_time']; ?>">

                            <select class="form-control" id="prep-duration-types" name="recipe[prep_time_duration]">
                                <option value="" disabled selected required hidden>Please select...</option>
                                <?php foreach ($recipe->getDurationTypes() as $durationType): ?>
                                    <option <?php if (isset($durationType)){ if ($durationType['duration'] == $recipeDetails['prep_time_duration']) echo 'selected';} ?>><?= $durationType['duration']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="col-xs-12 col-sm-4 prep-cook-time cook-time">

                            <h3>Cook</h3>

                            <input type="number" min="1"  class="form-control" required placeholder="4" name="recipe[cook_time]" value="<?= $recipeDetails['cook_time']; ?>">

                            <select class="form-control" id="prep-duration-types" name="recipe[cook_time_duration]">
                                <option value="" disabled selected required hidden>Please select...</option>
                                <?php foreach ($recipe->getDurationTypes() as $durationType): ?>
                                    <option <?php if (isset($durationType)){ if ($durationType['duration'] == $recipeDetails['cook_time_duration']) echo 'selected';} ?>><?= $durationType['duration']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>

                </div>

                <div class="col-12 directions-list-container">

                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <table class="table table-striped table-responsive table-directions">
                                <?php
                                $directionNum = 1;
                                foreach ($directions->getRecipeDirections($id) as $direction): ?>
                                    <tr class="individual-direction" id="<?= $direction['id'];?>">
                                        <td class="direction-number">
                                            <div class="direction-number-icon"><?= $directionNum; ?></div>
                                        </td>
                                        <td class="direction-text">
                                            <textarea type="" class="form-control" placeholder="" name="recipe[instruction_<?= $directionNum ?>]"><?= $direction['instruction']; ?></textarea>
                                        </td>
                                        <td class="direction-delete">
                                            <a class="delete-direction-btn"><span class="fas fa-times-circle" style="color: #f57e20; font-size: 20px;"></span></a>
                                        </td>
                                    </tr>
                                    <?php $directionNum++; endforeach; ?>
                            </table>

                            <span class="add-direction-btn">+ADD ANOTHER</span>

                        </div>

                    </div>

                </div>

            </section>

            <section class="row recipe-submit-container">

                <div class="col-md-4 offset-md-4 text-center">
                    <h4>All done & ready to publish?</h4>
                    <div class="btn-group">
                        <input id='submit' type='submit' name='submit' value='<?= $pageTitle; ?>' class="btn btn-default btn-lg <?= slugify($pageTitle); ?>-btn"/>

                    </div>
                </div>

            </section>

        </div>

    </form>

<?php include('app/includes/layout/footer.php'); ?>