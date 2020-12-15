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
<h1><?= $question->title ?> </h1>

<div class="question">
<table>
    <tr>
    </tr>
    <tr>
        <td><?= $question->text ?></td>
    </tr>
    <tr>
        <td>
            <p>
                Skapad av: <a href="<?= url("user/profile/{$user->id}"); ?>"> <?= $user->acronym ?></a><br>
                <a class="commentBtn" href="<?= url("comment/create/{$question->questionId}"); ?>">Kommentera</a>
            </p>
    </tr>
</table>
</div>


<p>Taggar:</p>
<?php foreach ($tags as $tag) : ?>
    <li class="Tag"><a href="<?= url("tags/view/{$tag->tag}"); ?>"><?= $tag->tag ?></a></li>
<?php endforeach; ?>
<?php foreach ($comments as $comment) :
    $userAnswer = $user->find('id', $comment->userId);
    if ($comment->answerId == 0):
        ?>
        <a href="<?= url("user/profile/{$userAnswer->id}"); ?>"> <?= $userAnswer->acronym ?></a>
        <p><?=$comment->text?></p>
        <?php
    endif;
endforeach; ?>
<br><br>

<?php foreach ($answers as $answer) :
    $userAnswer = $user->find('id', $answer->userId);
    ?>
    <div class="answers">
        <a href="<?= url("user/profile/{$userAnswer->id}"); ?>"> <?= $userAnswer->acronym ?></a>
        <p><?=$answer->text?></p>
        <div class="comments">
            <?php foreach ($comments as $comment) :
             if ($comment->answerId == $answer->answerId): ?>
             <a href="<?= url("user/profile/{$userAnswer->id}"); ?>"> <?= $userAnswer->acronym ?></a>
             <p><?=$comment->text?></p>
            <?php endif;
            endforeach;?>
        </div>
        <a class="commentBtn" href="<?= url("comment/createAnswer/{$answer->answerId}/{$question->questionId}"); ?>">Kommentera</a>
    </div>

<?php endforeach; ?>

<a href="<?= url("answer/create/{$question->questionId}"); ?>" class="comment button">Svara</a>

<a href="<?= url("question") ?>" class="button">Visa alla Frågor</a>
