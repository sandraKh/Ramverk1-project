<?php

namespace Anax\View;
?>

<h1>Taggar</h1>
<div class="tags">
<?php foreach ($tags as $tag) : ?>
  <tr>
      <td>
          <li class="Tag"><a href="<?= url("tags/view/{$tag}"); ?>"><?= $tag ?></a></li>
      </td>
  </tr>
<?php endforeach; ?>
</div>
