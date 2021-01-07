<?php

namespace Anax\View;

$tags = isset($tags) ? $tags : null;

?>

    <?php foreach ($tags as $tag) : ?>
        <div class="question">
        <h3><a href="<?= url("question/view/{$tag->questionId}"); ?>"><?= $tag->title ?></a></h3>
        <p><?= $tag->text; ?> </p>
        </div>
    <?php endforeach; ?>



<div class="showAllDiv">
    <a class="showAll" href="<?= url("tags") ?>" class="button">Visa alla Taggar</a>
</div>
