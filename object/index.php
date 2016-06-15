<?php
include('script.php');
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
            $view->delete();
            $view->view();
        }
        elseif (isset($_GET['title'])) {
            $todo->createTodo();
            $view->view();
        }
        else {
            $view->view();
        }

        ?>
    </table>
</div>

<div id="tasks">
    <h1>Tasks</h1>

    <form action="index.php" method="GET">
    <input required type="text" placeholder="New Task" name="title"><br>
    <input required name="deadline" type="date"><br>

    <select name="c_id" required>
        <option disabled selected value>-- Category --</option>
        <?php $todo->categorize(); ?>
    </select>
    <br>
    <select name="p_id" required>
        <option disabled selected value>-- Priority --</option>
        <?php $todo->prioritize(); ?>

    </select> <br>

    <button>ADD TODO</button>
    </form>
    <?php
    if (isset($_GET['title'])) {
        $todo->createTodo();
    }
    ?>
</div>


</body>




