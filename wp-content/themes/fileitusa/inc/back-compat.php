<?php
/**
 * File It USA Inc back compat functionality
 *
 * Prevents File It USA Inc from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package fileitusa
 
 * @since File It USA Inc 1.0.0
 */

/**
 * Prevent switching to File It USA Inc on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since File It USA Inc 1.0.0
 */
function fileitusa_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'fileitusa_upgrade_notice' );
}
add_action( 'after_switch_theme', 'fileitusa_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * File It USA Inc on WordPress versions prior to 4.7.
 *
 * @since File It USA Inc 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function fileitusa_upgrade_notice() {
	$message = sprintf( __( 'File It USA Inc requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'fileitusa' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since File It USA Inc 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function fileitusa_customize() {
	wp_die(
		sprintf(
			__( 'File It USA Inc requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'fileitusa' ),
			$GLOBALS['wp_version']
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'fileitusa_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since File It USA Inc 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function fileitusa_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'File It USA Inc requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'fileitusa' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'fileitusa_preview' );
