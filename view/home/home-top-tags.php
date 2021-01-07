<?php

namespace Anax\View;

?>

<h2>Populära Taggar</h2>
<div class="tagshome">
    <?php foreach ($toptags as $tag) : ?>
        <li class="Tag"><a href="<?= url("tags/view/{$tag->tag}"); ?>"><?= $tag->tag ?></a></li>
    <?php endforeach; ?>
</div>
