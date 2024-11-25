<div class="wrap">
    <h1 style="margin-bottom: 40px;">Δώσε πρόσβαση στους developers μας</h1>
    <div style="background: #f9f9f9; border: 1px solid #ddd; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . 'img/pilaslogo.png'); ?>" alt="Pilas Logo" style="max-width: 200px; margin-bottom: 20px;">
            <p>Το Pilas.Gr Access είναι ένα plugin που σας επιτρέπει να δημιουργείτε προσωρινά URL εισόδου για το διαχειριστικό περιβάλλον του WordPress. Αυτά τα URL σας παρέχουν πρόσβαση για συγκεκριμένες εργασίες ή τεχνική υποστήριξη.</p>
            <p>Μπορείτε να δημιουργήσετε νέο σύνδεσμο πρόσβασης και να ανακαλέσετε την πρόσβαση οποιαδήποτε στιγμή.</p>
        <form method="post">
            <p><strong>URL Εισόδου:</strong></p>
            <p>
                <?php
                $url = '';
                $users = get_users(['search' => 'pilasdevteam*', 'search_columns' => ['user_login']]);
                if (!empty($users)) {
                    $user = $users[0];
                    $token = get_user_meta($user->ID, 'pds_token', true);
                    $url = site_url('/wp-login.php') . '?pds_token=' . $token;
                }
                if ($url): ?>
                    <a href="<?php echo esc_url($url); ?>" target="_blank"><?php echo esc_html($url); ?></a>
                    <button type="button" onclick="copyToClipboard(this, '<?php echo esc_js($url); ?>')" style="margin-left: 10px; background-color: #007cba; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Αντιγραφή συνδέσμου</button>
                <?php else: ?>
                    Δεν υπάρχει προσωρινός χρήστης.
                <?php endif; ?>
            </p>
            <p class="submit">
                <input type="submit" name="create_temp_user" class="button-primary" value="Δημιουργία URL" style="background-color: #e82064; color: white; border-color: #e82064;">
                <input type="submit" name="revoke_access" class="button-secondary" value="Ανάκληση Πρόσβασης">
            </p>
        </form>
    </div>
</div>
<script>
    function copyToClipboard(button, text) {
        navigator.clipboard.writeText(text).then(function() {
            button.style.backgroundColor = '#000';
            button.style.color = '#fff';
            button.textContent = 'Ο σύνδεσμος αντιγράφηκε!';
            setTimeout(function() {
                button.style.backgroundColor = '#007cba';
                button.style.color = '#fff';
                button.textContent = 'Αντιγραφή συνδέσμου';
            }, 5000);
        });
    }
</script>
