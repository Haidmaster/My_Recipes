<?php
require_once('templates/header.php');
require_once('lib/recipe.php');

$id = $_GET['id'];

?>


<section class="recipes">
    <div class="container">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/images/recipe_default.jpeg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">
                    <?= $recipes[$id]['title'] ?>
                </h1>
                <p class="lead"><?= $recipes[$id]['description'] ?></p>
            </div>
        </div>
    </div>
</section>

<?php
require_once('templates/footer.php');
?>