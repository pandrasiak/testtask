<?php

function log_visit_to_google_sheet() {
    $webhook_url = 'https://script.google.com/macros/s/AKfycbxRCF7k-NvEUHQ0UQDRTMNhcji-6Im-ySl_hAUssqyW6pfL74HdP9dFHemxf6PvxxoX/exec'; 

    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
        . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    wp_remote_post($webhook_url, [
        'method' => 'POST',
        'body' => json_encode([
            'type' => 'visit',
            'url' => $current_url,
            'timestamp' => current_time('mysql')
        ]),
        'headers' => ['Content-Type' => 'application/json']
    ]);
}
add_action('template_redirect', 'log_visit_to_google_sheet');

function add_click_logger_script() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('click', function(event) {
                var target = event.target;

                fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'action=log_click&element=' + encodeURIComponent(target.tagName + (target.id ? '#' + target.id : '') + (target.className ? '.' + target.className.replace(/\s+/g, '.') : ''))
                });
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_click_logger_script');


function handle_log_click() {
    $webhook_url = 'https://script.google.com/macros/s/AKfycbxRCF7k-NvEUHQ0UQDRTMNhcji-6Im-ySl_hAUssqyW6pfL74HdP9dFHemxf6PvxxoX/exec'; 

    $element = sanitize_text_field($_POST['element'] ?? 'unknown');

    wp_remote_post($webhook_url, [
        'method' => 'POST',
        'body' => json_encode([
            'type' => 'click',
            'element' => $element,
            'timestamp' => current_time('mysql')
        ]),
        'headers' => ['Content-Type' => 'application/json']
    ]);

    wp_die();
}
add_action('wp_ajax_log_click', 'handle_log_click');
add_action('wp_ajax_nopriv_log_click', 'handle_log_click');
