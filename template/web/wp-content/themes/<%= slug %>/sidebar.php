<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 * @package  WordPress
 * @subpackage  Timber
 */

use Timber\Timber;

$data = array();

Timber::render( array( 'sidebar.twig' ), $data );
