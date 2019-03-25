<?php

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1>Email and Page Plugin Settings</h1>
  <?php
  // Let see if we have a caching notice to show
  $admin_notice = get_option('custom_wordpress_plugin_admin_notice');
  if($admin_notice) {
    // We have the notice from the DB, lets remove it.
    delete_option( 'custom_wordpress_plugin_admin_notice' );
    // Call the notice message
    $this->admin_notice($admin_notice);
  }
  if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
    $this->admin_notice("Your settings have been updated!");
  }
  ?>
  <form method="POST" action="options.php">
  <?php
    settings_fields('wordpress-custom-plugin-options');
    do_settings_sections('wordpress-custom-plugin-options');
    submit_button();
  ?>
  </form>
  <div>
      <h2>New saved value</h2>
      <p><?php echo get_option('custom_plugin_text_example') ?: 'Nothing saved yet'; ?></p>
  </div>
</div>