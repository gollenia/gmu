<?php

$script = require_once(__DIR__ . "/version.php");
add_action( 'wp_enqueue_scripts', function() use($script) {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' , [],
		$script['version']
	);
	wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' 	);
} );


add_action('admin_enqueue_scripts', function () use ($script) {
	wp_enqueue_style(
		'child-icons',
		"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200",
		[],
		"1.0.0"
	);
}, 99);

add_action( 'wp_head', 'ilc_favicon');
function ilc_favicon(){
    echo "<link rel='shortcut icon' href='" . get_stylesheet_directory_uri() . "/favicon.png' />" . "\n";
	echo "<style> root: {
		var(--primary): var(--wp--preset--color--primary);
	} </style>";
}



function add_event_template()
{
	if (!post_type_exists('event')) return;
	$page_type_object = get_post_type_object('event');
	$page_type_object->template = [
		['ctx-blocks/grid-row', [], [
			['ctx-blocks/grid-column', ['widthLarge' => 2], [['core/paragraph', ['placeholder' => 'Event-Beschreibung']],]],
			['ctx-blocks/grid-column', ['widthLarge' => 1], [
				['events-manager/details', []],
			]]
		]]
	];
}
add_action( 'init', 'add_event_template', 1000 );