<?php

$script = require_once(__DIR__ . "/version.php");
add_action( 'wp_enqueue_scripts', function() use($script) {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' , [],
		$script['version']
	);
	wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' 	);
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
		['core/separator'],
		['core/group', ['type' => 'flex', 'flexWrap' => 'nowrap'], [['events-manager/booking', ['title' => 'Anmeldung']]]]
	];
}

add_action( 'init', 'add_event_template', 1000 );