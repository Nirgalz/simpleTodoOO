<?php
ini_set('display_errors', 1);

date_default_timezone_set('UTC');

$mysqli = new mysqli("localhost", "root", "", "todo");
if ($mysqli->connect_errno) {
    echo "Echec connexion a MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}
mysqli_set_charset($mysqli, 'utf8');
