<?php

function gmu_blockquote_render( $attributes, $content ) {
	return Timber::compile( array( 'content/blockquote.twig' ), array('content' => $content, 'attributes' => $attributes) );
}