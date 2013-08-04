<?php

function iamawesome_wp_title( $title) {
	$title = "I Am Awesome! " . $title;
	return $title;
}

add_filter( 'wp_title', 'iamawesome_wp_title', 11);