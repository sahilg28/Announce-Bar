<?php
/**
 * Admin settings for AnnounceBar
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu
function announce_bar_add_admin_menu() {
    add_options_page(
        'AnnounceBar Settings',
        'AnnounceBar',
        'manage_options',
        'announce-bar',
        'announce_bar_settings_page'
    );
}
add_action('admin_menu', 'announce_bar_add_admin_menu');

// Register settings
function announce_bar_register_settings() {
    register_setting('announce_bar_settings', 'announce_bar_options');
    
    add_settings_section(
        'announce_bar_general_section',
        'Banner Settings',
        '',
        'announce_bar'
    );
    
    add_settings_field(
        'announce_bar_message',
        'Announcement Message',
        'announce_bar_message_callback',
        'announce_bar',
        'announce_bar_general_section'
    );
    
    add_settings_field(
        'announce_bar_button_text',
        'Button Text',
        'announce_bar_button_text_callback',
        'announce_bar',
        'announce_bar_general_section'
    );
    
    add_settings_field(
        'announce_bar_button_link',
        'Button Link',
        'announce_bar_button_link_callback',
        'announce_bar',
        'announce_bar_general_section'
    );
}
add_action('admin_init', 'announce_bar_register_settings');

// Field callbacks
function announce_bar_message_callback() {
    $options = get_option('announce_bar_options');
    $message = isset($options['message']) ? $options['message'] : '';
    
    echo '<textarea id="announce_bar_message" name="announce_bar_options[message]" rows="2" cols="50">' . esc_textarea($message) . '</textarea>';
}

function announce_bar_button_text_callback() {
    $options = get_option('announce_bar_options');
    $button_text = isset($options['button_text']) ? $options['button_text'] : '';
    
    echo '<input type="text" id="announce_bar_button_text" name="announce_bar_options[button_text]" value="' . esc_attr($button_text) . '" />';
}

function announce_bar_button_link_callback() {
    $options = get_option('announce_bar_options');
    $button_link = isset($options['button_link']) ? $options['button_link'] : '';
    
    echo '<input type="text" id="announce_bar_button_link" name="announce_bar_options[button_link]" value="' . esc_url($button_link) . '" class="regular-text" />';
}

// Settings page
function announce_bar_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('announce_bar_settings');
            do_settings_sections('announce_bar');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

// Add settings link to plugins page
function announce_bar_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=announce-bar">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_announce-bar/announce-bar.php", 'announce_bar_settings_link'); 