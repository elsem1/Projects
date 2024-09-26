<?php


function getValidationRules() {
    return [
        'name' => function($v) {
            $v->required()
                ->alpha('/^[a-zA-Z -]+$/')
                ->min_len(1)
                ->max_len(PHP_INT_MAX);
                
        },
        'number' => function($v) {
            $v->required()
                ->numeric()
                ->min_val(1)
                ->max_val(99);
        },
        'price' => function($v) {
            $v->required()
                ->preg_match("/^[0-9]{1,2}[,.]?[0-9]{0,2}$/");
        }
    ];
}
?>