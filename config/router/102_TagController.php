<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "TagController",
            "mount" => "tags",
            "handler" => "\Anax\Tag\TagController",
        ],
    ]
];
