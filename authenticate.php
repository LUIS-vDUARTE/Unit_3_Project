<?php
session_start();

function is_valid_admin_login($email, $password){
    require_once('db.php');
    $db = getDB();
    $query = 'SELECT password FROM nutManagers WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(":email", $email);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();

    if($row === false){
        return false;
    }else{
        $hash = $row['password'];
        return password_verify($password, $hash);
    }

}
//returning the inputs
$email = htmlspecialchars(filter_input(INPUT_POST, 'email'));
$password = htmlspecialchars(filter_input(INPUT_POST, 'password'));

if (is_valid_admin_login($email, $password)){
    $_SESSION['is_valid_admin'] = true;

    require_once("db.php");
    $db = getDB();
    $query = 'SELECT * FROM nutManagers WHERE emailAddress = :email';
    $statement= $db->prepare($query);
    $statement->bindvalue(':email',$email);
    $statement->execute();
    $row = $statement->fetch();
    $statement-> closeCursor();
    
    
    $_SESSION['email'] = $row['emailAddress'];
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['lastName'] = $row['lastName'];
    header("Location: index.php");
}

if (is_valid_admin_login($email, $password)){
    //create the valid session
    $_SESSION['is_valid_admin'] = true;
    echo "<p> You have succesfully logged in</p>";
}else {
    if ($email == NULL && $password == NULL){
        $login_message = 'You must login to view this page';
    }else{
        $login_message = 'Invalid Login, please try again';
    }
    include("login.php");
}