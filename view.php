
<?php

if (isset($_GET['cat'])) {
    $cat = $_GET['cat'];
}

$tasks = $mysqli->query("SELECT * FROM tasks INNER JOIN categories ON tasks.c_id=categories.c_id INNER JOIN priority ON tasks.p_id=priority.p_id");

if (!$categories) {
    echo "erreur sql" . $mysqli->error;
    exit();
}


if (isset($_GET['cat'])) {

    $taskscat = $mysqli->query("SELECT * FROM tasks INNER JOIN categories ON tasks.c_id=categories.c_id INNER JOIN priority ON tasks.p_id=priority.p_id WHERE tasks.c_id='$cat'");

    while ($taskc = $taskscat->fetch_object()) { ?>


        <tr><td><?= $taskc->title ?></td><td> <?= $taskc->deadline ?></td><td> <?= $taskc->c_title ?></td><td> <?= $taskc->p_title ?></td><td><a href="index.php?id=<?= $taskc->t_id ?>">edit</a> <br> <a href="index.php?ids=<?= $taskc->t_id ?>">del</a></td></tr>


    <?php }
}
else {
    while ($task = $tasks->fetch_object()) { ?>

<tr><td><?= $task->title ?></td><td> <?= $task->deadline ?></td><td><?= $task->c_title ?></td><td> <?= $task->p_title ?></td><td><a href="index.php?id=<?= $task->t_id ?>">edit</a> <br> <a href="index.php?ids=<?= $task->t_id ?>">del</a></td></tr>

    <?php }
}


?>


