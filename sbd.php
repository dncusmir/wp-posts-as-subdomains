<?php
/**
 * Setup wp posts as subdomains
 *
 * @package wpsbd
 * @author dncusmir
 *
 * @wordpress-plugin
 * Plugin Name:       WP Posts as Subdomains
 * Plugin URI:        https://github.com/dncusmir/wp-posts-as-subdomains/
 * Description:       Easy way to setup your wordpress posts as subdomains, change http://www.site_url/post_name/ to http://post_name.site_url/
 * Version:           1.0
 * Author:            dncusmir
 * Author URI:        https://github.com/dncusmir/
 **/

add_action( 'plugins_loaded', 'sbd_activation' );

function sbd_activation() {
	add_filter( 'post_link', 'sbd_post_link', 10, 3 );
}

function sbd_post_link( $permalink, $post, $leavename = false ) {
	if( $post->post_type != 'post' ) return $permalink;
	if( stripos( $permalink, '?p=' ) !== false ) return $permalink;
	$permalink = trim( $permalink, '/' );
	$location = strripos( $permalink, '/' );
	$url = substr( $permalink, $location + 1 );
	$permalink = substr( $permalink, 0, $location + 1 );
	$permalink = str_replace( '://www.', '://', $permalink );
	$permalink = str_replace( '://', '://' . $url . '.' , $permalink );
	return $permalink;
}