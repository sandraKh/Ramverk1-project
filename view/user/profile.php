<?php

namespace Anax\View;
?>

<div>
    <div class = "profileInfo">
        <h2><?= $user->acronym ?></strong></h2>
        <img class="gravatar" src="<?= "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email))) . "?d=" . urlencode("https://www.gravatar.com/avatar") . "&s=" . 175; ?>" alt="" />
        <p>Registrerad sedan: <i><?= $user->created ?></i></p>
    </div>
    <div class="profileBtn">
        <?php if ($this->di->session->get('UserLogged') == $user->id) : ?>
            <a class="commentBtn" href="<?= url("user/edit") ?>">Redigera</a>
            <a class="commentBtn" href="<?= url("user/logout") ?>">Logga ut</i></a>
            <?php
        endif;
        ?>
    </div>
</div>
