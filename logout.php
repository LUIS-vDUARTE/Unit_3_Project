<?php
session_start();

//set the session to an empty array
$_SESSION = [];
session_destroy();

header("Location: index.php")

?>