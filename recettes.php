<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
?>


<section class="recipes">
    <div class="container">
        <h1 class="display-5 fw-bold lh-1 m-3">
            Liste des recettes
        </h1>
        <div class="row">
            <?php foreach ($recipes as $key => $recipe) {
                include('templates\recipe_partial.php');
            } ?>
        </div>
    </div>
</section>

<?php
require_once('templates/footer.php');
?>