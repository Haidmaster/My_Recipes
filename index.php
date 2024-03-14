<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
?>

<body>

  <section class="hero hero__bg mb-4">
    <div class="container">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="assets/images/my-recipes-bg.jpeg" class="d-block mx-lg-auto img-fluid" alt="Log My Recipes" width="500" loading="lazy" />
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold lh-1 mb-3">
            My Recipes
          </h1>
          <h2> Des recettes à votre goût</h2>
          <p class="lead">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident,
            reprehenderit! Optio, nam? Maxime, molestiae velit. Quae, totam
            accusantium natus doloribus labore ratione. Molestiae ab dicta explicabo
            assumenda totam velit. Enim.
          </p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="recettes.php" class="btn btn-primary">Voir nos recettes</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="recipes mb-4 ">
    <div class="container">
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