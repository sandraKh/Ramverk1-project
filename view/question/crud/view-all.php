<?php

namespace Anax\View;


?>

<?php if (!$item) : ?>
    <p>Det finns inga frågor att visa.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
    <tr>
        <td><h3><a href="<?= url("question/view/{$item->questionId}"); ?>"><?= $item->title ?></a> </h3></td>
    </tr>
    <tr>
        <td><?= $item->text ?></td>
    </tr>
    <tr>
        <td>
            Fråga ställd av: <?= $userInfo->acronym ?></p>
            <a href="<?= url("comment/create/{$item->questionId}"); ?>" class="commentbtn">Svara</a>
        </td>
    </tr>
</table>
