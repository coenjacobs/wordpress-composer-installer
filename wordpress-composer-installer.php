<?php

/*
 * Plugin Name: WordPress Composer Installer
 */

add_action( 'admin_init', 'wpci_admin_init' );

function wpci_admin_init() {
	if ( ! isset( $_GET['action'] ) || $_GET['action'] !== 'composer_install' ) {
		return;
	}

	if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'composer_install_plugin' ) ) {
		return;
	}

	wpci_execute_composer_install();
}

function wpci_execute_composer_install() {
	require( 'vendor/autoload.php' );

	putenv('COMPOSER_HOME=' . __DIR__ . '/vendor/bin/composer'); // know where to run composer from
	putenv('COMPOSER_VENDOR_DIR=' . trailingslashit( WP_CONTENT_DIR ) . 'vendor'); // target dir for vendor folder

	$input = new Symfony\Component\Console\Input\ArrayInput( array(
		'command'  => 'install',
		'-d'       => trailingslashit( WP_PLUGIN_DIR ) . dirname( $_GET['plugin'] ),
		'--no-dev' => true,
	) );

	$output = null; //new Symfony\Component\Console\Output\StreamOutput(fopen('php://output','w'));
	$app = new Composer\Console\Application();
	$app->setAutoExit(false);
	$app->run($input,$output);
}

add_filter( 'plugin_action_links', 'wpci_plugin_action_links', 10, 4 );

function wpci_plugin_action_links( $actions, $plugin_file, $plugin_data, $context ) {
	$composer_link = wp_nonce_url( 'plugins.php?action=composer_install&amp;plugin='.$plugin_file, 'composer_install_plugin' );
	$actions['composer'] = '<a href="'.$composer_link.'">Composer install</a>';
	return $actions;
}