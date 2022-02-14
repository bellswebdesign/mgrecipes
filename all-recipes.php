<?php require_once('app/initialize.php');

$pageTitle = 'All Recipes';

$recipe = new Recipe();
$allRecipes = $recipe->getAllRecipes();

include('app/includes/layout/header.php');
include('app/includes/layout/banner.php');
?>
    <div class="<?= pageSlug($pageTitle); ?>">

        <?php
        $recipeCount = 1;
        foreach ($allRecipes as $recipe):
        ?>

            <section class="recipe <?= ($recipeCount % 2 == 0 ? 'even' : 'odd'); ?> <?= slugify($recipe['name']); ?>">

                <div class="container">

                    <div class="col-md-10 offset-md-1 recipe-details">

                        <div class="row">

                            <div class="col-12">
                                <h2 class="recipe-name">
                                    <a href="recipe?id=<?= $recipe['id']; ?>"><?= $recipe['name']; ?></a>
                                </h2>
                            </div>

                            <div class="col-md-8 recipe-information">

                                <div class="recipe-description">
                                    <?= $recipe['description']; ?>
                                </div>

                                <div class="row recipe-buttons">
                                    <div class="col-md-4 recipe-button">
                                        <a href="recipe?id=<?= $recipe['id']; ?>" class="btn btn-default btn-lg">View</a>
                                    </div>
                                    <div class="col-md-4 recipe-button">
                                        <a href="edit-recipe?id=<?= $recipe['id']; ?>" class="btn btn-default btn-lg">Edit</a>
                                    </div>
                                    <div class="col-md-4 recipe-button">
                                        <a id="<?= $recipe['id']; ?>" href="#" class="btn btn-default btn-lg delete-recipe-btn">Delete</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4 recipe-image">
                                <a href="recipe?id=<?= $recipe['id']; ?>"><img src="assets/img/_default_img.png" alt="" width="" height="" border="0"/></a>
                            </div>

                        </div>

                    </div>

                </div>

            </section>

        <?php $recipeCount++; endforeach; ?>

    </div>

<?php include('app/includes/layout/footer.php'); ?>