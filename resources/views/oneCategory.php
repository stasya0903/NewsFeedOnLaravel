<?php
include('menu.php');
?>
<h3><?= $category ?></h3>

<?php foreach ($news as $item): ?>
<a href="<?= route('news.NewsOne', $item['id'] ) ?>"> <?= $item['title'] ?>
    <br>
    <?php endforeach; ?>


