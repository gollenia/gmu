<?php

function core_columns_render( $attributes, $content ) {
    $content = preg_replace("/wp-block-columns/", 'row', $content, 1);
    //$content = preg_replace("/has-(\d+)-columns/", 'small-up-1 medium-up-$1', $content, 1);
    //var_dump($retval);
    return Timber::compile( array( 'content/columns.twig' ), array('content' => $content, 'attributes' => $attributes) );
}