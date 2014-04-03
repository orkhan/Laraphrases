<?php

return [
    'can_edit' => function() {
        return true; // Your custom filter: Sentry::check() && Sentry::getUser()->hasAccess('laraphrases') ? true : false
    },
    'is_editable_mode_on' => function() {
        return isset($_COOKIE['editing_mode']) && $_COOKIE['editing_mode'] === "false" ? false : true;
    },
    'white_list' => [
        'Phrase' => ['value'],
        'User' => ['email'],
    ],
];