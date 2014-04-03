<?php

return [
    'can_edit' => function() {
        return true;
    },
    'is_editable_mode_on' => function() {
        return $_COOKIE['editing_mode'] === "false" ? false : true;
    },
    'white_list' => [
        'Phrase' => ['value'],
        'User' => ['email'],
    ],
];