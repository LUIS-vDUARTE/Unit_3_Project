<?php
require_once('db.php');
$db = getDB();

$nutCategoryID = filter_input(INPUT_POST,'nutCategory');
$nutCode = filter_input(INPUT_POST, 'nutCode');
$nutName = filter_INPUT(INPUT_POST, 'nutName');
$description = filter_input(INPUT_POST, 'description');
$price = filter_input(INPUT_POST,'price', FILTER_VALIDATE_FLOAT);

$nutCode = htmlspecialchars($nutCode);
$nutName = htmlspecialchars($nutName);
$description = htmlspecialchars($description);

$query = 'SELECT nutCode FROM nut';
$statement1=$db->prepare($query);
$statement1->execute();
$codes = $statement1->fetchAll();
$statement1->closeCursor();
$codesSingle = [];
foreach($codes as $code){
    $codesSingle[] = $code['nutCode'];
}
if($price<0||$price>100.00){
    $error_message = 'Please enter a valid price that does not pass 100';
}
else if(in_array($nutCode, $codesSingle)){
    $error_message = 'And item with code already exists in the database';
}else{
    $error_message='';
}
if($error_message !=''){
    echo "there is an error";
    include('create.php');
    exit();
}
$query = 'INSERT INTO nut(nutCategoryID, nutCode, nutName, description, price, dateAdded)
          VALUE
          (:nutCategoryID, :nutCode, :nutName, :description, :price, Now())';

        $statement2=$db->prepare($query);
        $statement2->bindValue(':nutCategoryID', $nutCategoryID);
        $statement2->bindValue(':nutCode', $nutCode);
        $statement2->bindValue(':nutName', $nutName);
        $statement2->bindValue(':description', $description);
        $statement2->bindValue(':price', $price);
        $statement2->execute();
        $statement2->closeCursor();

        include('create.php');
?>