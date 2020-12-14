<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$comments = isset($comments) ? $comments : null;

// Create urls for navigation
$urlToViewItems = url("comment");



?>
<h1>Create a item</h1>
<div class="answerBox">

</div>


<p>
    <a href="<?= $urlToViewItems ?>">View all</a>
</p>
