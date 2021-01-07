<?php

namespace Anax\View;

?>


<div class="question">
    <h3>Kommentar på frågan: <a class="userAllQuestTitle" href="<?= url("question/view/{$question->questionId}"); ?>"> <?= $question->title ?></a></h3>

<div class="userComment">
    <p><?= $comment->text ?></p>
</div>
</div>
