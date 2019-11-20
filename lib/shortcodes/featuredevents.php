<?php

function featuredevents_shortcode( $atts ) {

$a = shortcode_atts( array(
   'limit' => "3",
), $atts );
$title = "Events";

if (class_exists('EM_Events')) {
    $upcoming = EM_Events::get(array('limit'=>$a['limit'],'orderby'=>'date', 'category' => 'featured'));
}
$images = array();
foreach ($upcoming as $key => $value) {
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ), 'large' );
  array_push($images, new Timber\Image($image[0]));
}


return Timber::compile( array( 'shortcodes/featuredevents.twig'), array('events' => $upcoming, 'title' => $title, 'images' => $images));
}