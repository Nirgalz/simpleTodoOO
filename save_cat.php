<?php
include('config.php');

$title = $_REQUEST['titre_cat'];
$sql = "INSERT INTO categories(c_title) VALUES ('$title')";
$query = $mysqli->query($sql);

header('Location: index.php');
exit();

?>

