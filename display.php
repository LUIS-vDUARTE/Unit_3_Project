<!DOCTYPE html>
<html>
<head>
    <title>Shipping Label</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="logo.png" alt="Nut Stand Logo" hieght = "250">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shipping.php">Shipping</a></li>
                <li><a href="nut.php">View orders</a>><li>
                <li><?php if(isset($_SESSION['isset'])){?>
                <a id ="log_button" href = "logout.php">Log in</a>
                <a id = "get nut" href = "processing.php">Shipping</a>
                <?php } else { ?>
                <a id = "log_button" href = "index.php">LogOut</a>
                <?php }?> <li>

            </ul>
        </nav>
    </header>
    
    <section id="shipping-label">
        <h1>Shipping Label</h1>
        <?php
        //Luis Duarte, 10/5/23, IT 202 005, Unit 5 assigment and lvd@njit.edu.
        // Retrieve form data from the POST request
        $from_address = "TheNuttyShop"; 
        $to_first_name = filter_input(INPUT_POST, 'to_first_name', FILTER_SANITIZE_STRING);
        $to_last_name = filter_input(INPUT_POST, 'to_last_name', FILTER_SANITIZE_STRING);
        $to_street = filter_input(INPUT_POST, 'to_street', FILTER_SANITIZE_STRING);
        $to_city = filter_input(INPUT_POST, 'to_city', FILTER_SANITIZE_STRING);
        $to_state = filter_input(INPUT_POST, 'to_state', FILTER_SANITIZE_STRING);
        $to_zip = filter_input(INPUT_POST, 'to_zip', FILTER_SANITIZE_NUMBER_INT);
        $ship_date = filter_input(INPUT_POST, 'ship_date', FILTER_SANITIZE_STRING);
        $order_number = filter_input(INPUT_POST, 'order_number', FILTER_SANITIZE_STRING);
        $package_dimensions = filter_input(INPUT_POST, 'package_dimensions', FILTER_SANITIZE_STRING);
        $package_weight = filter_input(INPUT_POST, 'package_weight', FILTER_VALIDATE_FLOAT);

        $errors = array();

        if (empty($to_first_name) || empty($to_last_name) || empty($to_street) || empty($to_city) || empty($to_state) || empty($to_zip) || empty($ship_date) || empty($order_number) || empty($package_dimensions) || $package_weight === false) {
            $errors[] = "All fields are required.";
        }
        
        // Validate ZIP Code (check if it's a valid 5-digit number)
        if (!preg_match('/^\d{5}$/', $to_zip)) {
            $errors[] = "ZIP Code should be a valid 5-digit number.";
        }
        
        // Validate City (check if it contains only letters)
        if (!ctype_alpha(str_replace(' ', '', $to_city))) {
            $errors[] = "City should contain only letters.";
        }
        
        $dimensions = explode('x', $package_dimensions);
        $max_dimension = max($dimensions);
        
        if ($max_dimension > 36) {
            $errors[] = "One or more dimensions of the package exceed the maximum allowed (36 inches).";
        }
        
        if ($package_weight > 150) {
            $errors[] = "Package weight should not exceed 150 pounds.";
        }
        
        // Display errors or shipping label information
        if (!empty($errors)) {
            echo "<div class='error-box'><ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul></div>";
        } else {
            // Display the shipping label information
            echo "<p><strong>From Address:</strong> $from_address</p>";
            echo "<p><strong>To Address:</strong><br>$to_first_name $to_last_name<br>$to_street<br>$to_city, $to_state $to_zip</p>";
            echo "<p><strong>Package Dimensions:</strong> $package_dimensions</p>";
            echo "<p><strong>Package Weight:</strong> $package_weight lbs</p>";
            echo "<p><strong>Shipping Company:</strong> USPS</p>";
            echo "<p><strong>Shipping Class:</strong> Priority Mail</p>";
            echo "<p><strong>Tracking Number:</strong> 123456</p>";
            echo "<img src='bc.jpg' alt='Tracking Number Barcode'>";
            echo "<p><strong>Order Number:</strong> $order_number</p>";
            echo "<p><strong>Ship Date:</strong> $ship_date</p>";
        }
        ?>
    </section>
    
    <footer>
        <p>&copy; 2023 TheNuttyShop</p>
    </footer>
</body>
</html>
