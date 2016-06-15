<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>zimplon-todo</title>
</head>

<body>

<?php
ini_set('display_errors', 1);
date_default_timezone_set('UTC');


class connection
{
    var $host;
    var $username;
    var $password;
    var $db;
    var $mysqli;

    function __construct($par1, $par2, $par3, $par4)
    {
        $this->host = $par1;
        $this->username = $par2;
        $this->password = $par3;
        $this->db = $par4;
    }

    function connect()
    {
        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->db);
        mysqli_set_charset($this->mysqli, 'utf8');
        if ($this->mysqli->connect_errno) {
            echo "Echec connexion a MySQL : (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
            exit();
        }
    }
}


class categories extends connection
{
    function affich()
    {
        connection::connect();
        $categories = $this->mysqli->query('SELECT * FROM categories');
        while ($category = $categories->fetch_object()) {
            echo '<a href="index.php?cat=' . $category->c_id . '">' . $category->c_title . '</a><br>';
        }
        echo '<form action="index.php" method="GET">
    <input required type="text" placeholder="New Category" name="new_cat"><br>

    <input name="submit" type="submit">
</form>';
    }
    function saveCat() {
        connection::connect();
        $title = $_REQUEST['new_cat'];
        $sql = "INSERT INTO categories(c_title) VALUES ('$title')";
        $query = $this->mysqli->query($sql);
    }

}

$cat = new categories("localhost", "root", "momo", "todo");


?>

<div id="categories">
    <h1>Categories</h1>
    <a href="index.php">ALL</a><br>
    <?php
    if (isset($_GET['new_cat'])) {
        $cat->saveCat();
        $cat->affich();
    }
    else {
        $cat->affich();
    }
    ?>
</div>

<div id="viewer">
    <h1>Viewer</h1>
    <table>
        <tr>
            <td>TODO</td><td>Deadline</td><td>Category</td><td>Priority</td><td>Actions</td>
        </tr>
        <?php
        if (isset($_GET['ids'])) {
            include('suppr.php');
        }
        else {
            include('view.php');
        }
        ?>
    </table>
</div>

<div id="tasks">
    <h1>Tasks</h1>
    <?php
    if (isset($_GET['id']) ) {
        include('edit_todo.php');
    }
    else {
        include('create_todo.php');
    }
    ?>
</div>


</body>




