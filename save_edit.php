<?php
include('config.php');

$id= $_REQUEST['id'];
$title = $_REQUEST['title'];
$c_id = $_REQUEST['c_id'];
$p_id = $_REQUEST['p_id'];
$deadline = $_REQUEST['deadline'];


$sql = "UPDATE tasks SET title='$title', c_id='$c_id', p_id='$p_id', deadline='$deadline' WHERE t_id='$id'";
$query = $mysqli->query($sql);

header('Location: index.php');
exit();

?>
