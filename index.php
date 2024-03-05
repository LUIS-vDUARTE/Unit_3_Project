<!DOCTYPE html>
<html>
<head>
    <title>Your Nut Stand</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
session_start();



if (!isset($_SESSION['is_valid_admin'])) {
    header("Location: admin_error.php");
}?>

    <header>
        <div id="logo">
            <img src="logo.png" alt="Nut Stand Logo" height = 250>
        </div>
        <nav>
            <ul>
                <li><a href="create.php">Create</a><li>
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
    <main>
    <section id="home">
        <h1>Welcome to TheNuttyShop</h1>
        <h3><?php echo"welcome ".$_SESSION['firstName']." ".$_SESSION['lastName']. " (". $_SESSION['email'].")!";?></h3>
        <br>
        <p>
            Located in 2959 Jones Street Grand Prairie, Texas(TX), 75051
        </p>
        <br>
        <p>
            Your Nutty Delights is a family-owned nut stand dedicated to providing 
            the finest selection of nuts in town. Founded in 2004, our passion for quality
            nuts has driven us to serve all types of nuts to our customers. Feel free to 
            browse our selection below and place your order by going to the shipping page.
        </p>
        <div id="image-gallery">
            <figure>
                <img src="alm.jpg" alt="Almonds" height="175">
                <figcaption>Almonds</figcaption>
            </figure>
            <figure>
                <img src="cash.jpg" alt="Cashews" height="175">
                <figcaption>Cashews</figcaption>
            </figure>
            <figure>
                <img src="pcans.jpg" alt="Pecans" height="150">
                <figcaption>Pecans</figcaption>
            </figure>
            <figure>
                <img src="asort.jpg" alt="Assorted Nuts" height ="175">
                <figcaption>Assorted Nuts</figcaption>
            </figure>
        </div>
    </section>
    </main>
    <footer>
        <p>&copy; 2023 TheNuttyShop</p>
    </footer>
</body>
</html>
