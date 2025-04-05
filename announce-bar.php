<?php
/**
 * Plugin Name: AnnounceBar
 * Plugin URI: https://wordpress.org/plugins/
 * Description: A simple announcement banner plugin for your WordPress website.
 * Version: 1.0.0
 * Author: Sahil
 * Text Domain: announce-bar
 */

if (!defined('ABSPATH')) {
    exit;
}
// Define plugin constants
define('ANNOUNCE_BAR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ANNOUNCE_BAR_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
require_once ANNOUNCE_BAR_PLUGIN_DIR . 'includes/admin-settings.php';
require_once ANNOUNCE_BAR_PLUGIN_DIR . 'includes/display-functions.php';

// Register activation hook
register_activation_hook(__FILE__, 'announce_bar_activate');

// Activation function
function announce_bar_activate() {
    $default_options = array(
        'message' => 'Announcement message',
        'button_text' => 'Click Here',
        'button_link' => '#'
    );
    
    if (!get_option('announce_bar_options')) {
        add_option('announce_bar_options', $default_options);
    }
}

// Register deactivation hook
register_deactivation_hook(__FILE__, 'announce_bar_deactivate');

// Deactivation function
function announce_bar_deactivate() {
    // Clean up if needed
}

// Initialize the plugin
function announce_bar_init() {
    // Load text domain for translations
    load_plugin_textdomain('announce-bar', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'announce_bar_init');

// Enqueue scripts and styles
function announce_bar_enqueue_scripts() {
    wp_enqueue_style('announce-bar-styles', ANNOUNCE_BAR_PLUGIN_URL . 'assets/css/announce-bar.css');
}
add_action('wp_enqueue_scripts', 'announce_bar_enqueue_scripts'); 