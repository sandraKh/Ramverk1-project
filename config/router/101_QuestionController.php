<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "QuestionController",
            "mount" => "question",
            "handler" => "\Anax\Question\QuestionController",
        ],
    ]
];
