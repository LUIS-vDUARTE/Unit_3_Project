<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Shipping Label</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="logo.png" alt="Nut Stand Logo" height = '250'>
        </div>
        <h3><?php echo"welcome ".$_SESSION['firstName']." ".$_SESSION['lastName']. " (". $_SESSION['email'].")!";?></h3>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="processing.php">Shipping</a></li>
                <li><a href="nut.php">View orders</a><li>
                <li><?php if(isset($_SESSION['isset'])){?>
                <a id ="log_button" href = "logout.php">Log Out</a>
                <a id = "get nut" href = "processing.php">Shipping</a>
                <?php } else { ?>
                <a id = "log_button" href = "index.php">LogOut</a>
                <?php }?> <li>
            </ul>
        </nav>
    </header>
    
    <section id="shipping">
        <h1>Shipping Label</h1>
        <form action="display.php" method="post">
            <label for="to_first_name">First Name:</label><br>
            <input type="text" id="to_first_name" name="to_first_name" required><br>

            <label for="to_last_name">Last Name:</label><br>
            <input type="text" id="to_last_name" name="to_last_name" required><br>

            <label for="to_street">Street Address:</label><br>
            <input type="text" id="to_street" name="to_street" required><br>

            <label for="to_city">City:</label><br>
            <input type="text" id="to_city" name="to_city" required><br>

            <label for="to_state">State:</label><br>
            <input type="text" id="to_state" name="to_state" required><br>

            <label for="to_zip">ZIP Code:</label><br>
            <input type="text" id="to_zip" name="to_zip" required><br>

            <label for="ship_date">Ship Date:</label><br>
            <input type="date" id="ship_date" name="ship_date" required><br>

            <label for="order_number">Order Number:</label><br>
            <input type="text" id="order_number" name="order_number" required><br>

            <label for="package_dimensions">Package Dimensions (L x W x H inches):</label><br>
            <input type="text" id="package_dimensions" name="package_dimensions" required><br>

            <label for="package_weight">Package Weight (lbs):</label><br>
            <input type="number" id="package_weight" name="package_weight" step="0.01" min="0.01" max="150" required><br>

            <input type="submit" value="Generate Label">
        </form>
    </section>
    
    <footer>
        <p>&copy; 2023 TheNuttyShop</p>
    </footer>
</body>
</html>