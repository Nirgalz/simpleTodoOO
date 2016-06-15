<?php include('config.php');

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>zimplon-todo</title>
</head>

<body>

<div id="categories">
    <h1>Categories</h1>
    <a href="index.php">ALL</a><br>
    <?php
    include('categories.php');
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
</html>