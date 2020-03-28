<?php
include('menu.php');
?>
<?php foreach ($category as $item): ?>
<a href="<?= route('news.categories.one', $item['name'] ) ?>"> <?= $item['name'] ?>
    <br>
<?php endforeach; ?>


