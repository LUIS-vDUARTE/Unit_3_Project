<?php
require_once('db.php');

function add_nut_manager($db,$email, $password, $firstName, $lastName) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO nutManagers (emailAddress, password, firstName, lastName)
              VALUES (:email, :password, :firstName, :lastName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hash);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->execute();
    $statement->closeCursor();
}

add_nut_manager($db,"MarcoNutty@gmail.com","HelloWorld","Marco", "Parker");
add_nut_manager($db,"NancyNutty@gmail.com","tvClips43","Nancy", "Lopez");
add_nut_manager($db,"LuisNutty@gmail.com","Chicle202","Luis", "Duarte");
?>