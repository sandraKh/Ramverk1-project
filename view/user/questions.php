<?php

namespace Anax\View;

?>


<div class="question">
    <h3><a class="userAllQuestTitle" href="<?= url("question/view/{$question->questionId}"); ?>"> <?= $question->title ?></a></h3>
    <div class="userQuestion">
        <p><?= $question->text ?></p>
    </div>
</div>
