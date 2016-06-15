<?php
include('config.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
};



// on récupère l'article existant par le parametre GET id

$task = $mysqli->query("SELECT * FROM tasks WHERE t_id = $id");
$categories = $mysqli->query('SELECT * FROM categories');
$priority = $mysqli->query('SELECT * FROM priority');

if (!$task || !$categories || !$priority) {
    echo "Erreur sql : " . $mysqli->error;
    exit();
}
$task = $task->fetch_object();
?>

<form action="save_edit.php" method="get">
    <input type="hidden" name="id" value="<?=$id?>">

    <input required type="text" placeholder="Titre de l'article" name="title" value="<?= $task->title ?>"><br>
    <input required name="deadline" type="date" value="<?=$task->deadline ?>"><br>

    <select required name="c_id">
        <?php while ($categorie = $categories->fetch_object()) { ?>

            <option value="<?= $categorie->c_id ?>"
                <?php if ($categorie->c_id == $task->c_id) {
                    echo 'selected';
                } ?>
            >
                <?= $categorie->c_title?>
            </option>
        <?php } ?>
    </select>
    <br>
    <select required name="p_id">
        <?php while ($priorities = $priority->fetch_object()) { ?>

            <option value="<?= $priorities->p_id ?>"
                <?php if ($priorities->p_id == $task->p_id) {
                    echo 'selected';
                } ?>
            >
                <?= $priorities->p_title?>
            </option>
        <?php } ?>
    </select> <br>



    <button>EDIT TODO</button>
</form>
