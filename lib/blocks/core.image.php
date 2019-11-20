<?php

function core_image_render( $attributes, $content ) {
	$content = str_replace("wp-block-image", "figure", $content);//var_dump($content);
	$content = str_replace("wp-image", "figure-img img-fluid ", $content);//var_dump($content);
	$content = str_replace("<figcaption>", "<figcaption class='figure-caption'>", $content);//var_dump($content);
	return $content;
}