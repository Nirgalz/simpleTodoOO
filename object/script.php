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

    function saveCat()
    {
        connection::connect();
        $title = $_REQUEST['new_cat'];
        $query = $this->mysqli->query("INSERT INTO categories(c_title) VALUES ('$title')");
    }

}

$cat = new categories("localhost", "root", "momo", "todo");

class viewer extends connection
{
    var $cat;
    var $ids;

    function view()
    {
        connection::connect();
        if (isset($_GET['cat'])) {
            $this->cat = $_GET['cat'];
        }

        $tasks = $this->mysqli->query("SELECT * FROM tasks INNER JOIN categories ON tasks.c_id=categories.c_id INNER JOIN priority ON tasks.p_id=priority.p_id");

        if (isset($_GET['cat'])) {
            $taskscat = $this->mysqli->query("SELECT * FROM tasks INNER JOIN categories ON tasks.c_id=categories.c_id INNER JOIN priority ON tasks.p_id=priority.p_id WHERE tasks.c_id='$this->cat'");
            while ($taskc = $taskscat->fetch_object()) {
                echo '<tr><td>' . $taskc->title . '</td><td> ' . $taskc->deadline . ' </td><td> ' . $taskc->c_title . ' </td><td> ' . $taskc->p_title . ' </td><td><a href="index.php?id='.$taskc->t_id.'">edit</a> <br> <a href="index.php?ids='.$taskc->t_id.'">del</a></td></tr>';
            }
        } else {
            while ($task = $tasks->fetch_object()) {
                echo '<tr><td>' . $task->title . '</td><td> ' . $task->deadline . ' </td><td> ' . $task->c_title . ' </td><td> ' . $task->p_title . ' </td><td><a href="index.php?id='.$task->t_id.'">edit</a> <br> <a href="index.php?ids='.$task->t_id.'">del</a></td></tr>';
            }
        }
    }
    function delete() {
        if (isset($_GET['ids'])) {
            connection::connect();
            $this->ids = $_GET['ids'];
            $del = $this->mysqli->query("DELETE FROM tasks WHERE t_id='$this->ids'");
        }
    }
}
$view = new viewer("localhost", "root", "momo", "todo");

class tasks extends connection{
    var $categories;
    var $priorities;

    function categorize() {
        connection::connect();
        $this->categories = $this->mysqli->query('SELECT * FROM categories');
        
        while ($categorie = $this->categories->fetch_object()) {
            echo '<option value="'. $categorie->c_id .'">'.$categorie->c_title .'</option>';
        }
    }
    function prioritize() {
        connection::connect();
        
        $this->priorities = $this->mysqli->query('SELECT * FROM priority');
        while ($prio = $this->priorities->fetch_object()) {
            echo '<option value="'. $prio->p_id .'">'.$prio->p_title .'</option>';
        }
    }
    function createTodo() {
        connection::connect();
            $title = $_REQUEST['title'];
            $c_id = $_REQUEST['c_id'];
            $p_id = $_REQUEST['p_id'];
            $deadline = $_REQUEST['deadline'];
            $this->mysqli->query("INSERT INTO tasks(title, c_id, p_id, deadline) VALUES ('$title','$c_id', '$p_id', '$deadline')");

    }

}

$todo = new tasks("localhost", "root", "momo", "todo");