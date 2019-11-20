<?php

function gmu_cover_render( $attributes, $content ) {
    $regex = '#<p class=["\']wp-block-cover-text[\'"]*>(.*?)</p>#';
    preg_match($regex, $content, $matches, PREG_OFFSET_CAPTURE);
    $headings = explode ( "<br/>" , $matches);
    return Timber::compile( array( 'content/cover.twig' ), array('headings' => $headings, 'attributes' => $attributes) );
}