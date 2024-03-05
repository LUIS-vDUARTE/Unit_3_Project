<?php
//Luis Duarte, 10/5/23, IT 202 005, Unit 5 assigment and lvd@njit.edu.
session_start();
$isAdmin = isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin'];
require_once('db.php');
$db = getDB();

// Get the Category ID
$nutCategory_id = filter_input(INPUT_GET, 'nutCategory_id', FILTER_VALIDATE_INT);

if ($nutCategory_id == NULL || $nutCategory_id == FALSE) {
    $nutCategory_id = 1; // Default to a specific category if none is provided
}

// Get the name for the category selected
$queryCategory = 'SELECT * FROM nutCategories WHERE nutCategoryID = :nutCategory_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':nutCategory_id', $nutCategory_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['nutCategoryName'];
$statement1->closeCursor();

// Get all categories
$queryAllCategories = 'SELECT * FROM nutCategories ORDER BY nutCategoryName';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get all nut items, not just those of the selected category
$queryNuts = 'SELECT * FROM nut ORDER BY nutID';
$statement3 = $db->prepare($queryNuts);
$statement3->execute();
$nuts = $statement3->fetchAll();
$statement3->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nut Category</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles2.css">
</head>
<body>
<header>
        <div id="logo">
            <img src="logo.png" alt="Nut Stand Logo" hieght = "250">
        </div>
        <h3><?php echo"welcome ".$_SESSION['firstName']." ".$_SESSION['lastName']. " (". $_SESSION['email'].")!";?></h3>
        <nav>
            <ul>
                <li><a href="create.php">Create</a><li>
                <li><a href="index.php">Home</a></li>
                <li><a href="shipping.php">Shipping</a></li>
                <li><a href="nut.php">View orders</a><li>
                <li><?php if(isset($_SESSION['isset'])){?>
                <a id ="log_button" href = "logout.php">Log in</a>
                <a id = "get nut" href = "processing.php">Shipping</a>
                <?php } else { ?>
                <a id = "log_button" href = "index.php">LogOut</a>
                <?php }?> <li>
            </ul>
        </nav>
    </header>
    <h1>Nut Category: <?php echo $category_name; ?></h1>

<table>
    <tr>
        <th>Nut Code</th>
        <th>Nut Name</th>
        <th>Description</th>
        <th>Price</th>
        <?php if (isset($_SESSION['is_valid_admin'])) : ?>
            <th>Action</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($nuts as $nut) : ?>
        <tr>
            <td>
                <?php
                $nutId = $nut['nutID'];
                $nutCode = $nut['nutCode'];
                echo "<a href='details.php?nut_id=$nutId'>$nutCode</a>";
                ?>
            </td>
            <td><?php echo $nut['nutName']; ?></td>
            <td><?php echo $nut['description']; ?></td>
            <td><?php echo $nut['price']; ?></td>
            <?php if (isset($_SESSION['is_valid_admin'])) : ?>
                <td>
                    <form action="delete_nut.php" method="post" onsubmit="return confirmDelete();">
                        <input type="hidden" name="nut_id" value="<?php echo $nutId; ?>" />
                        <input type="hidden" name="nut_category_id" value="<?php echo $nut['nutCategoryID']; ?>" />
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to continue? Doing so will delete the selected item from memory.");
    }
</script>
</body>
</html>

