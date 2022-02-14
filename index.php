<?php require_once('app/initialize.php');

$pageTitle = 'Dashboard';

$recipe = new Recipe();
$allRecipes = $recipe->getAllRecipes();

include('app/includes/layout/header.php');

include('app/includes/layout/banner.php');
?>

    <div class="<?= pageSlug($pageTitle); ?>">


            <section class="all-recipes-container">

        <div class="">
        	<div class="col-md-3 pull-left">
        		<div class="row">
        			<div class="widgets-header col-sm-12"><h4>Left side bar</h4></div>
        			<div class="widgets-inner-text recipe-inner col-sm-12">
        				<p>Left side widgets div</p>
        			</div>
        		</div>
        		<div class="row">
        			<div class="widgets-header col-sm-12"><h4>Left side bar</h4></div>
        			<div class="widgets-inner-text recipe-inner col-sm-12">
        				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae lorem in orci vehicula suscipit.</p>
        			</div>
        		</div>
        	</div>
		</div>
<!-- Right Side bar -->
	<div class="">
        	<div class="col-md-3 pull-right">
        		<div class="row">
        			<div class="widgets-header col-sm-12"><h4>Right side bar</h4></div>
        			<div class="widgets-inner-text recipe-inner col-sm-12">
        				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae lorem in orci vehicula suscipit.</p>
        			</div>
        		</div>
        		<div class="row">
        			<div class="widgets-header col-sm-12"><h4>Right side bar</h4></div>
        			<div class="widgets-inner-text recipe-inner col-sm-12">
        				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae lorem in orci vehicula suscipit.</p>
        			</div>
        		</div>
        	</div>
		</div
<!-- Main -->
<div class="row">
	<div class="widgets-header col-sm-12"><h4>Main</h4></div>
	<div class="recipe-inner widgets-inner-text col-md-12">

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae lorem in orci vehicula suscipit. Sed commodo lectus nec laoreet dictum. Ut rhoncus lectus est, vel hendrerit massa luctus sit amet. Mauris ac nibh laoreet, sagittis ex ac, malesuada enim. Etiam faucibus sollicitudin urna, at varius metus. Suspendisse et sapien ornare, blandit mauris id, tristique justo. Vestibulum varius mi tincidunt.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae lorem in orci vehicula suscipit. Sed commodo lectus nec laoreet dictum. Ut rhoncus lectus est, vel hendrerit massa luctus sit amet. Mauris ac nibh laoreet, sagittis ex ac, malesuada enim. Etiam faucibus sollicitudin urna, at varius metus.
		</p>
	</div>

</div>

<div class="clearfix"></div>

            </section>

    </div>

<?php include('app/includes/layout/footer.php'); ?>
