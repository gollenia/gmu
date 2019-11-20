<?php

function core_heading_render( $attributes, $content ) {
	return Timber::compile( array( 'content/heading.twig' ), array('content' => $content) );
}