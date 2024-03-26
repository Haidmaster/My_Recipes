<?php

// Fonction pour recupérer une recette avec son id
function getRecipeById(PDO $pdo, int $id)
{
    $sql = "SELECT * FROM recipes WHERE id = :id";

    $query = $pdo->prepare($sql);

    // On sécurise le requête avec la fonction bindParam
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    $query->execute();
    return $query->fetch();
}

// Fonction pour recupérer l'image ou mettre une image par default si aucune image n'est trouvée
function getRecipeImage(string|null $image)
{
    if ($image === null) {
        return _ASSETS_IMG_PATH_ . 'recipe_default.jpeg';
    } else {
        return _RECIPES_IMG_PATH_ . $image;
    }
}

// Fonction pour recupérer toutes les recettes
function getRecipes(PDO $pdo, int $limit = null)
{
    $sql = "SELECT * FROM recipes ORDER BY id DESC";

    if ($limit) {
        // On concatène la requete si le paramètre limit est utilisé
        $sql .= ' LIMIT :limit';
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        // On sécurise le requête avec la fonction bindParam
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}


// Fonction pour inserer une nouvelle recette dans la bdd
function saveRecipe(PDO $pdo, int $category, string $title, string $description, string $ingredients, string $instructions, string|null $image)
{
    $sql = "INSERT INTO `recipes` (`id`,`category_id`,`title`, `description`, `ingredients`, `instructions`, `image`) 
    VALUES(NULL, :category_id,:title,:description,:ingredients,:instructions, :image)";

    $query = $pdo->prepare($sql);
    // On sécurise le requête avec la fonction bindParam
    $query->bindParam(':category_id', $category, PDO::PARAM_INT);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $query->bindParam(':image', $image, PDO::PARAM_STR);
    return $query->execute();
}
