<?php
$categories = $mysqli->query('SELECT * FROM categories');

if (!$categories) {
    echo "erreur sql" . $mysqli->error;
    exit();
}
?>
<?php
    while ($category = $categories->fetch_object()) { ?>
<a href="index.php?cat=<?= $category->c_id ?>"><?= $category->c_title ?> </a><br>
   <?php }
?>

<form action="save_cat.php" method="GET">
    <input required type="text" placeholder="New Category" name="titre_cat"><br>

    <input name="submit" type="submit">
</form>