<?php
/**
 * Display functions for AnnounceBar
 */
if (!defined('ABSPATH')) {
    exit;
}

function announce_bar_display() {
    $options = get_option('announce_bar_options');
    $message = isset($options['message']) ? $options['message'] : 'Announcement message';
    $button_text = isset($options['button_text']) ? $options['button_text'] : 'Click Here';
    $button_link = isset($options['button_link']) ? $options['button_link'] : '#';
    ?>
    <div id="announce-bar" class="announce-bar">
        <div class="announce-bar-container">
            <div class="announce-bar-message"><?php echo esc_html($message); ?></div>
            <?php if (!empty($button_text)) : ?>
                <a href="<?php echo esc_url($button_link); ?>" class="announce-bar-button">
                    <?php echo esc_html($button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

function announce_bar_add_to_website() {
    announce_bar_display();
}
add_action('wp_body_open', 'announce_bar_add_to_website');

function announce_bar_wp_body_open_fallback() {
    if (!function_exists('wp_body_open')) {
        function wp_body_open() {
            do_action('wp_body_open');
        }
    }
}
add_action('wp', 'announce_bar_wp_body_open_fallback');