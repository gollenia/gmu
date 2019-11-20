<?php

function core_paragraph_render( $attributes, $content ) {
	$dom = new DOMDocument();
  	$dom->preserveWhiteSpace = FALSE;
  	$dom->loadHtml( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	$text = $dom->getElementsByTagName( 'p' )[ 0 ];
	$data[ 'class' ] = $text->getAttribute('class');
	$data[ 'text' ] = preg_replace("/<.*?>/", "", $content);
	return Timber::compile( array( 'content/paragraph.twig' ), $data );
}