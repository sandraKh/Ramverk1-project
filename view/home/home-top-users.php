<?php

namespace Anax\View;

$userInfo = isset($userInfo) ? $userInfo : null;

?>

<h2>Aktiva Användare</h2>

<?php foreach ($userInfo as $userInfos) :?>
    <div class="topUsers">
        <a href="<?= url("user/profile/{$userInfos->id}"); ?>"> <?= $userInfos->acronym ?></a>
    </div>
<?php
endforeach; ?>
