<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <a href="<?= $article->getid().'/edit' ?>">Подредактировать</a>
    <a href="<?= $article->getid().'/delete' ?>">Удалить статью</a>
 
<?php include __DIR__ . '/../footer.php'; ?>