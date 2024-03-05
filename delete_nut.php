 <?php
require_once('db.php');
$db = getDB();

$nut_id = filter_input(INPUT_POST, 'nut_id', FILTER_VALIDATE_INT);
$nut_category_id = filter_input(INPUT_POST, 'nut_category_id', FILTER_VALIDATE_INT);

if ($nut_id != FALSE && $nut_category_id != FALSE) {
    $query = 'DELETE FROM nut WHERE nutID = :nut_id';
    $statement = $db->prepare($query);
    $statement ->bindValue(':nut_id', $nut_id);
    $statement ->execute();
    $statement ->closeCursor();


    // Redirect back to the referring page (nut.php)
    header("Location: nut.php");


}

?>   
