<?php
/**
 * Plugin Name: PDF Block
 * Plugin URI: https://github.com/ahmadawais/create-guten-block/
 * Description: The simple, no-frills block to easily embed PDF files on your WordPress site.
 * Author: henryholtgeerts
 * Author URI: https://henryholtgeerts.com
 * Version: 1.1.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package PDFB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
