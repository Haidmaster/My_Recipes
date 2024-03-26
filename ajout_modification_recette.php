<?php
require_once('templates/header.php');

if (!isset($_SESSION['user'])) {
    header('location: login.php');
}


require_once('lib/tools.php');
require_once('lib/recipe.php');
require_once('lib/category.php');



$errors = [];
$messages = [];
$recipe =
    [
        'title' => '',
        'description' => '',
        'ingredients' => '',
        'description' => '',
        'instructions' => '',
        'category_id' => '',
    ];

if (isset($_POST['saveRecipe'])) {
    $filename = null;
    // Si un fichier a été envoyé
    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '') {
        $checkImage = getimagesize($_FILES['file']['tmp_name']);
        if ($checkImage !== false) {
            // Si c'est une image on traite
            $filename = uniqid() . '-' . slugify($_FILES['file']['name']);

            move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_ . $filename);
        } else {
            // Sinon on affiche un message d'érreur
            $errors[] = 'Le fichier doit être une image';
        }
    }

    if (!$errors) {
        $res = saveRecipe($pdo, $_POST['category'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $filename);

        if ($res) {
            $messages[] = "La recette a bien été sauvegardée";
        } else {
            $errors[] = "La recette n\'a pas été sauvegardée";
        }
    }
    $recipe =
        [
            'title' => $_POST['title'],
            'description' =>  $_POST['description'],
            'description' => $_POST['description'],
            'ingredients' => $_POST['ingredients'],
            'instructions' => $_POST['instructions'],
            'category_id' => $_POST['category'],
        ];
}

$categories = getCategories($pdo);

?>

<div class="container">
    <h1>Ajouter une recette</h1>

    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success">
            <?= $message; ?>
        </div>
    <?php } ?>

    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger">
            <?= $error; ?>
        </div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb3">
            <label for="title" class="form-label mt-2">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= $recipe['title'] ?>">
        </div>

        <div class="mb3">
            <label for="description" class="form-label mt-2">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control"><?= $recipe['description']; ?></textarea>
        </div>
        <div class="mb3">
            <label for="ingredients" class="form-label mt-2">Ingredients</label>
            <textarea name="ingredients" id="ingredients" cols="30" rows="5" class="form-control"><?= $recipe['ingredients']; ?></textarea>
        </div>
        <div class="mb3">
            <label for="instructions" class="form-label mt-2">Instructions</label>
            <textarea name="instructions" id="instructions" cols="30" rows="5" class="form-control"><?= $recipe['instructions']; ?></textarea>
        </div>
        <div class="mb3">
            <label for="category" class="form-label mt-2">Catégorie</label>
            <select name="category" id="category" class="form-select">
                <?php foreach ($categories as $category) {
                ?>
                    <option value="<?= $category['id']; ?>" <?php if ($recipe['catergory_id'] ==  $category['id']) {
                                                                echo "selected = selected";
                                                            } ?>><?= $category['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb3">
            <label for="file" class="form-label mt-2">Image</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>

        <input type="submit" value="Enregistrer" name="saveRecipe" class="btn btn-primary mt-2">

    </form>
</div>
<?php
require_once('templates/footer.php');
?>