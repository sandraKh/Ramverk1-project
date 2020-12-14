<?php

namespace Anax\View;


$tags = isset($tags) ? $tags : null;

?>

<?php foreach ($tags as $tag) : ?>
    <h2><a href="<?= url("question/view/{$tag->questionId}"); ?>"><?= $tag->title ?></a></h2>
    <p><?= $tag->text; ?> </p>
<?php endforeach; ?>

<br><a href="<?= url("tags") ?>" class="button">Visa alla Taggar</a>
