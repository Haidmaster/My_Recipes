<?php
require_once('templates/header.php');
require_once('lib/tools.php');
require_once('lib/recipe.php');


$id = (int)$_GET['id'];

$recipe =  getRecipeById($pdo, $id);


if ($recipe) {

    $ingredients = linesToArray($recipe['ingredients']);
    $instructions = linesToArray($recipe['instructions']);
?>

    <section class="recipes">

        <div class="container">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="<?= getRecipeImage($recipe['image']); ?>" class="d-block mx-lg-auto img-fluid" alt="<?= $recipe['title']; ?>" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">
                        <?= $recipe['title'] ?>
                    </h1>
                    <p class="lead"><?= $recipe['description']; ?></p>
                </div>
            </div>

            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <h2>Ingredients</h2>
                <ul class="list-group">
                    <?php foreach ($ingredients as $key => $ingredient) { ?>
                        <li class="list-group-item"><?= $ingredient; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <h2>Intructions</h2>
                <ol class="list-groupe list-group-numbered">
                    <?php foreach ($instructions as $key => $instruction) { ?>
                        <li class="list-group-item"><?= $instruction; ?></li>
                    <?php } ?>
                </ol>
            </div>
        </div>

    <?php } else { ?>
        <div class="row text-center">
            <h1 class="display-5 fw-bold lh-1 mb-3">Recette introuvable</h1>
        </div>
    <?php } ?>


    </section>



    <?php
    require_once('templates/footer.php');
    ?>