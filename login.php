<?php
require_once('templates/header.php');
require_once('lib/user.php');

$errors = [];
$messages = [];



if (isset($_POST['loginUser'])) {

    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user) {
        $_SESSION['user'] = ['email' => $user['email']];
        header('location: index.php');
    } else {
        $errors[] = "email ou mot de passe incorrect";
    }
}

?>

<div class="container">

    <h1>Veuillez vous connecter</h1>

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
            <label for="email" class="form-label mt-2">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb3">
            <label for="password" class="form-label mt-2">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <input type="submit" value="Connexion" name="loginUser" class="btn btn-primary mt-2">
    </form>

</div>

<?php
require_once('templates/footer.php');
?>