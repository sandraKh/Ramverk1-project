<?php

namespace Anax\View;

?>

<?php if (!$question) : ?>
    <p>Det finns ingen fråga att titta på.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <td><h3><?= $question->title ?> </h3></td>
    </tr>
    <tr>
        <td><?= $question->text ?></td>
    </tr>
    <tr>
        <td>
            <p>
                Skapad av: <?= $user->acronym ?><br>
            </p>
        </td>
    </tr>
</table>

<a href="<?= url("question") ?>" class="button">Se alla</a>
