<?php

require_once('db.php');

// Check if nut_id is set in the URL
if (isset($_GET['nut_id'])) {
    $nutId = $_GET['nut_id'];

    // Perform a database query to fetch the nut record
    $db = getDB();
    $query = 'SELECT * FROM nut WHERE nutID = :nutId';
    $statement = $db->prepare($query);
    $statement->bindValue(':nutId', $nutId);
    $statement->execute();

    $nut = $statement->fetch();

    if ($nut) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nut Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        #nutImage {
            max-width: 100%;
            height: auto;
        }

        #nutImage:hover {
            filter: grayscale(100%); /* Apply full greyscale*/
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <h1>Nut Details</h1>
    <p>Nut Code: <?php echo $nut['nutCode']; ?></p>
    <p>Nut Name: <?php echo $nut['nutName']; ?></p>
    <p>Description: <?php echo $nut['description']; ?></p>
    <p>Price: <?php echo $nut['price']; ?></p>

    <!-- Display image using nut ID with mouseover effect -->

<img
    id="nutImage"
    class="nut-image"
    src="images/<?php echo $nutId; ?>.jpg"
    alt="Nut Image"
    onmouseover="changeImage('images/<?php echo $nutId; ?>_hover.jpg')"
    onmouseout="changeImage('images/<?php echo $nutId; ?>.jpg')"
>
    <script>
        function changeImage(newSrc) {
            document.getElementById('nutImage').src = newSrc;
        }
    </script>
</body>
</html>

<?php
    } else {
        echo "Error: Nut record not found in the database.";
    }
} else {
    // nut_id not set in the URL, display an error
    echo "Error: Nut ID not provided in the URL.";
}
?>