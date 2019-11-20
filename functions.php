<?php
/**
 * GMU Theme
 *
 * @package  WordPress
 * @subpackage  GMU-Theme
 * @since   Timber 0.1
 */

require_once( __DIR__ . '/vendor/autoload.php' );

// Load Timber
//require_once( __DIR__ . '/vendor/autoload.php' );
$timber = new Timber\Timber();

// Load Configuration
use Symfony\Component\Yaml\Yaml;
$config = Yaml::parseFile(__DIR__ . '/config.yml');
// Debug into Console, if needed
//echo "<script>console.log(" . json_encode($config) . ")</script>";

setlocale(LC_TIME, $config['locale']);

include_once('lib/helpers.php');
require_once( __DIR__ . '/lib/classes/site.php' );


if ( ! class_exists( 'Timber' ) ) {
	die('Timber not active');
}

// Sets the directories (inside your theme) to find .twig files
Timber::$dirname = array( 'templates', 'views' );



new \Contexis\Site($config);

function kb_admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
	wp_enqueue_style('admin-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
 }
add_action('admin_enqueue_scripts', 'kb_admin_style');