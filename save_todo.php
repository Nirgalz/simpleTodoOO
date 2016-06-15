<?php
include('config.php');

$title = $_REQUEST['title'];
$c_id = $_REQUEST['c_id'];
$p_id = $_REQUEST['p_id'];
$deadline = $_REQUEST['deadline'];


$sql = "INSERT INTO tasks(title, c_id, p_id, deadline) VALUES ('$title','$c_id', '$p_id', '$deadline')";
$query = $mysqli->query($sql);

header('Location: index.php');
exit();

?>

