<?php

add_action('wp_enqueue_scripts', 'gmu_enqueue_icons');
add_action('admin_enqueue_scripts', 'gmu_enqueue_icons');

function gmu_enqueue_icons(): void {
    wp_enqueue_style(
        'material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200',
        [],
        null
    );
}