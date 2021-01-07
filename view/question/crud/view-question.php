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

    <p><?= $question->text ?></p>
    <p>Skapad av: <a  class = "user" href="<?= url("user/profile/{$user->id}"); ?>"> <?= $user->acronym ?></a><br></p>
    <div class="tagShow">
        <?php foreach ($tags as $tag) : ?>
            <li class="Tag"><a href="<?= url("tags/view/{$tag->tag}"); ?>"><?= $tag->tag ?></a></li>
        <?php endforeach; ?>
    </div>
    <a class="myButton" href="<?= url("comment/create/{$question->questionId}"); ?>">Kommentera</a>
</div>

<div class="comments">
    <?php foreach ($comments as $comment) :
        $userAnswer = $user->find('id', $comment->userId);
        if ($comment->answerId == 0) :
            ?>
            <div class="commentsrow">
                <div class="commentsShow">
                    <p><?=$comment->text?>  -  <a  class = "user" href="<?= url("user/profile/{$userAnswer->id}"); ?>"> <?= $userAnswer->acronym ?></a></p>
                </div>
            </div>
            <?php
        endif;
    endforeach; ?>
</div>
<br><br>

<div class="answersection">


    <?php foreach ($answers as $answer) :
        $userAnswer = $user->find('id', $answer->userId);
        ?>
        <div class="answerBox">

            <div class="answers">
                <a class = "user" href="<?= url("user/profile/{$userAnswer->id}"); ?>"> <?= $userAnswer->acronym ?></a>
                <p><?=$answer->text?></p>
                <div class="comments">
                    <?php foreach ($comments as $comment) :
                        if ($comment->answerId == $answer->answerId) : ?>
                        <div class="commentsrow">
                            <div class="commentsShow">
                                <p><?=$comment->text?>  -  <a  class = "user" href="<?= url("user/profile/{$userAnswer->id}"); ?>"> <?= $userAnswer->acronym ?></a></p>
                            </div>
                        </div>
                        <?php endif;
                    endforeach;?>
            </div>
            <a class="myButton" href="<?= url("comment/createAnswer/{$answer->answerId}/{$question->questionId}"); ?>">Kommentera</a>
        </div>

    <?php endforeach; ?>
</div>



</div>
<div class="commentBtnDiv">
    <a class = "commentBtn" href="<?= url("answer/create/{$question->questionId}"); ?>" class="comment button">Svara</a>
</div>
<div class="showAllDiv">
    <a class="showAll" href="<?= url("question") ?>" class="button">Visa alla Frågor</a>
</div>
