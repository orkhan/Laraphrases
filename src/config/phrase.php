<?php

return [
    'can_edit' => function() {
        return true; // Your custom filter: Sentry::check() && Sentry::getUser()->hasAccess('laraphrase') ? true : false
    },
    'is_editable_mode_on' => function() {
        return $_COOKIE['editing_mode'] === "false" ? false : true;
    },
    'white_list' => [
        'Phrase' => ['value'],
        'User' => ['email'],
    ],
];