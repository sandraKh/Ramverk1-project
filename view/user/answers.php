<?php

namespace Anax\View;

?>


<div class="question">
    <h3>Svar på frågan: <a class="userAllQuestTitle" href="<?= url("question/view/{$question->questionId}"); ?>"> <?= $question->title ?></a></h3>

<div class="userAnswer">
    <p><?= $answer->text ?></p>
</div>
</div>
