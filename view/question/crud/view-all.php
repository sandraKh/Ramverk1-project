<?php

namespace Anax\View;

?>

<?php if (!$item) : ?>
    <p>Det finns inga frågor att visa.</p>
    <?php
    return;
endif;
?>

<div class="question">

    <h3><a href="<?= url("question/view/{$item->questionId}"); ?>"><?= $item->title ?></a> </h3>

    <div class="textQuestion">
        <p><?= $item->text ?></p>
    </div>
    <p>Fråga ställd av: <?= $userInfo->acronym ?></p>

</div>
