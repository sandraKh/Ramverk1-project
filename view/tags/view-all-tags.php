<?php

namespace Anax\View;
?>

<h1>Taggar</h1>
<div class="tags">
<?php foreach ($tags as $tag) : ?>
  <tr>
      <td>
          <a class="pageTag" href="<?= url("tags/view/{$tag}"); ?>"> <?= $tag ?></a>
      </td>
  </tr>
<?php endforeach; ?>
</div>
