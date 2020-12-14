<?php

namespace Anax\View;

?>

<?php
if (!$question) : ?>
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
                <a class="commentBtn" href="<?= url("comment/create/{$question->questionId}"); ?>">Kommentera</a>
            </p>
        </td>
    </tr>
</table>

<p>Taggar:</p>
<?php foreach ($tags as $tag) : ?>
    <li class="Tag"><a href="<?= url("tags/view/{$tag->tag}"); ?>"><?= $tag->tag ?></a></li>
<?php endforeach; ?>
<?php foreach ($comments as $comment) :
    $userAnswer = $user->find('id', $comment->userId);
    if ($comment->answerId == 0):
        ?>
        <?= $userAnswer->acronym . ": " . $comment->text ?><br><br>
        <?php
    endif;
endforeach; ?>
<br><br>

<?php foreach ($answers as $answer) :
    $userAnswer = $user->find('id', $answer->userId);
    ?>
    <div class="comments">
        <?= $userAnswer->acronym . ": " . $answer->text ?><br><br>
        <div class="answers">
            <?php foreach ($comments as $comment) :
             if ($comment->answerId == $answer->answerId): ?>
             <?= $userAnswer->acronym . ": " . $comment->text ?><br><br>
            <?php endif;
            endforeach;?>
        </div>
        <a class="commentBtn" href="<?= url("comment/createAnswer/{$answer->answerId}/{$question->questionId}"); ?>">Kommentera</a>
    </div>

<?php endforeach; ?>

<a href="<?= url("answer/create/{$question->questionId}"); ?>" class="comment button">Svara</a>

<a href="<?= url("question") ?>" class="button">Visa alla Frågor</a>
