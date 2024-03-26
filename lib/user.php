<?php
// Fonction pour ajouter un utilisateur avec un mot de passe crypter en passant par la fonction password_hash()
function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password)
{
    $sql = "INSERT INTO `users` (`first_name`,`last_name`, `email`, `password`, `role`) 
    VALUES(:first_name,:last_name,:email,:password, :role)";
    $query = $pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_DEFAULT);
    $role = "subscriber";

    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    return $query->execute();
}

// Fonction permettant de verifier le mot de passe
function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}
