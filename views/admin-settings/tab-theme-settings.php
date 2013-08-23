<?php if ( ! defined( 'MOBILE_PLUGIN_SETTINGS_NO_FORM' ) ): ?>

<form action="" method="POST">
<div id="poststuff">
<?php do_action( 'wpmp_current_theme_settings' ) ?>
</div>
<input type="hidden" name="nonce" value="<?php echo $nonce ?>" />
</form>

<?php else: ?>

<?php do_action( 'wpmp_current_theme_settings' ) ?>

<?php endif; ?>