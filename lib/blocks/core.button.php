<?php

function core_button_render( $attributes, $content ) {
  $dom = new DOMDocument();
  $dom->preserveWhiteSpace = FALSE;
  $dom->loadHtml( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	$text = $dom->getElementsByTagName( 'a' )[ 0 ];
	$data[ 'class' ] = $attributes['className'];
	$data[ 'text' ] = preg_replace("/<.*?>/", "", $content);
  $data[ 'href' ] = $text->getAttribute('href');
	return Timber::compile( array( 'content/button.twig' ), $data );
	var_dump($attributes);
}