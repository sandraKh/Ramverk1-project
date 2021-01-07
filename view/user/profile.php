<?php

namespace Anax\View;

?>

<div>
    <div class = "profileInfo">
        <h2><?= $user->acronym ?></strong></h2>
        <img class="gravatar" src="<?= "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email))) . "?d=" . urlencode("https://www.gravatar.com/avatar") . "&s=" . 175; ?>" alt="" />
        <p>Registrerad: <i><?= $user->created ?></i></p>
        <p>Poäng: <i><?= $user->active ?></i></p>

        <div class="userRank">
            <?php if ($user->active > 10) : ?>
                <p>Rank: Guld</p>
            <?php elseif ($user->active > 5) : ?>
                <p>Rank: Silver</p>
                <?php
            elseif ($user->active > 0) : ?>
                <p>Rank: Brons</p>

            <?php endif;?>
        </div>
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

<h1>Ställda Frågor</h1>
