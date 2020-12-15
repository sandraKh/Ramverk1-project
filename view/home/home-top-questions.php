<?php

namespace Anax\View;
?>

<h2>Senaste Frågor Om Boktips</h2>

<?php foreach ($questions as $question) : ?>
    <div class="question">
        <h3><a href="<?= url("question/view/{$question->questionId}"); ?>"><?= $question->title ?></a> </h3>
            <?= $question->text ?>
    </div>
<?php endforeach; ?>
