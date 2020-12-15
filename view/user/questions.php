<?php

namespace Anax\View;
?>


<div class="userAllQuestions">
    <a class="userAllQuestTitle" href="<?= url("question/view/{$question->questionId}"); ?>"> <?= $question->title ?></a>
</div>
<div class="userQuestion">
    <p><?= $question->text ?></p>
</div>
