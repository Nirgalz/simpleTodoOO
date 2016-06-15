<?php
include('config.php');

if (isset($_GET['ids'])) {
    $id = $_GET['ids'];
}


$sql = "DELETE FROM tasks WHERE t_id='$id'";

$query = $mysqli->query($sql);

header('Location: index.php');
exit();

?>