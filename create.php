<?php
//Luis Duarte, 10/5/23, IT 202 005, Unit 5 assigment and lvd@njit.edu.
session_start();
$isAdmin = isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin'];
require_once('db.php');
$db=getDB();

$queryCategory = 'SELECT * FROM nutCategories ORDER BY nutCategoryID';
$statement1 = $db->prepare($queryCategory);
$statement1->execute();
$categories = $statement1->fetchAll();
$statement1->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Nut</title>
    <link rel="stylesheet" href ="styles.css"/>
</head>
<body>
<header>
        <div id="logo">
            <img src="logo.png" alt="Nut Stand Logo" hieght = "250">
        </div>
        <h3><?php echo"welcome ".$_SESSION['firstName']." ".$_SESSION['lastName']. " (". $_SESSION['email'].")!";?></h3>
        <nav>
            <ul>
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
<h2>Add a product</h2>
<p>Use the form to create a desire bread product. See the 
   exisiting products to see how and what information should be inputed</p>
<form id = "addNutForm"action= "add_nut_form.php" method="post">
    <h2>Item creation Forum</h2>
    <p style ="color: red">
    <?php if(!empty($error_message)){?>
        <?php echo htmlspecialchars($error_message);?>
    </p>
    <?php } ?>
    <label>Category</label>
    <select name = "nutCategory" method = "post">
        <?php foreach($categories as $category) : ?>
            <option value = "<?php echo $category['nutCategoryID']; ?>">
            <?php echo $category['nutCategoryName'];?>
        </option>
    <?php endforeach; ?>
    </select>
    <br>

    <label>Code:</label>
    <input type="text" name="nutCode" maxlength="8"/>
    <br>

    <label>Name:</label>
    <input type="text" name="nutName"/>
    <br>

    <label>Description</label>
    <br>
    <textarea name="description" rows="7" cols="35"></textarea>

    <label>Price(MAX $100): $</label>
    <input type="number" name="price" min= "0" max="100" step="any"/>
    <br>

    <input type="submit"/>

</form>
<footer>
        <p>&copy; 2023 TheNuttyShop</p>
</footer>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            var isValid = validateForm();

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });

        function validateForm() {
            var isValid = true;

            // Validate Nut Code
            var nutCodeInput = document.querySelector('input[name="nutCode"]');
            if (nutCodeInput.value.trim() === '' || nutCodeInput.value.length < 4 || nutCodeInput.value.length > 10) {
                alert('Nut Code validation failed');
                isValid = false;
            }

            // Validate Nut Name
            var nutNameInput = document.querySelector('input[name="nutName"]');
            if (nutNameInput.value.trim() === '' || nutNameInput.value.length < 10 || nutNameInput.value.length > 100) {
                alert('Nut Name validation failed');
                isValid = false;
            }

            // Validate Nut Description
            var descriptionTextarea = document.querySelector('textarea[name="description"]');
            if (descriptionTextarea.value.trim() === '' || descriptionTextarea.value.length < 10 || descriptionTextarea.value.length > 255) {
                alert('Nut Description validation failed');
                isValid = false;
            }

            // Validate Nut Price
            var priceInput = document.querySelector('input[name="price"]');
            var priceValue = parseFloat(priceInput.value);
            if (isNaN(priceValue) || priceValue <= 0 || priceValue > 100000) {
                alert('Nut Price validation failed');
                isValid = false;
            }

            return isValid;
        }
        var resetButton = document.createElement("button");
        resetButton.innerHTML = "Reset";
        resetButton.type = "button";
        resetButton.addEventListener("click", function () {
            form.reset();
        });

        form.appendChild(resetButton);
    });
</script>
