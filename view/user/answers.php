<?php

namespace Anax\View;

?>


<div class="userAllQuestions">
    <a class="userAllQuestTitle" href="<?= url("question/view/{$question->questionId}"); ?>"> <?= $question->title ?></a>
</div>
<div class="userAnswer">
    <p><?= $answer->text ?></p>
</div>
