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
        <div class="textQuestion">
            <td><?= $item->text ?></td>
        </div>
    </tr>
    <tr>
        <td>
            Fråga ställd av: <?= $userInfo->acronym ?></p>
        </td>
    </tr>
</table>
