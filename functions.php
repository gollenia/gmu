<?php

$script = require_once(__DIR__ . "/version.php");
add_action( 'wp_enqueue_scripts', function() use($script) {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' , [],
		$script['version']
	);
	wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' 	);
	wp_enqueue_style( 'inria', 'https://fonts.googleapis.com/css2?family=Inria+Sans:ital,wght@0,400;0,700;1,400&display=swap' 	);
} );

add_action( 'admin_enqueue_scripts', function() use($script) {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/admin.css' , [],
		$script['version']
	);
} );

add_action( 'wp_head', 'ilc_favicon');
function ilc_favicon(){
    echo "<link rel='shortcut icon' href='" . get_stylesheet_directory_uri() . "/favicon.png' />" . "\n";
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
		]],
		['core/separator']
	];
}
add_action( 'init', 'add_event_template', 1000 );