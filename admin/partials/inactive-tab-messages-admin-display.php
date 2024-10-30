<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://igorsumonja.com/
 * @since      1.0.0
 *
 * @package    Inactive_Tab_Messages
 * @subpackage Inactive_Tab_Messages/admin/partials
 */

$page_title = $this->menupage['page_title'];
$slug       = $this->menupage['slug'];
?>

<div class="wrap">
    <h2><?php esc_html( $page_title ); ?></h2>

	<?php settings_errors(); ?>

    <form method="post" action="options.php">
		<?php
		settings_fields( $slug );
		do_settings_sections( $slug );
		submit_button();
		?>
    </form>
</div>
