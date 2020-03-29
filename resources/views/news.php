
<?php foreach ($news as $item): ?>
<a href="<?= route('news.NewsOne', $item['id'] ) ?>"> <?= $item['title'] ?>
    <br>
    <?php endforeach; ?>


