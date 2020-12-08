<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$viewAll = url("question");



?>

<?= $form ?>

<p>
    <a href="<?= $viewAll ?>">Se Alla</a>
</p>
