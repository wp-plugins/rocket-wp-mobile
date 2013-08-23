<?php
/**
 * Footer.php outputs the code for your footer widgets, contains your footer hook and closing body/html tags
 * @package Thoughts WordPress Theme
 * @since 1.0
 * @author AJ Clarke : http://wpexplorer.com
 * @copyright Copyright (c) 2012, AJ Clarke
 * @link http://wpexplorer.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
global $data; // Globals 
?>
<div class="clear"></div><!-- /clear any floats -->
<?php wpex_hook_content_bottom(); ?>
</div><!-- /main-content -->
<?php wpex_hook_content_after(); ?>
	<div id="footer-wrap">
    	<?php wpex_hook_footer_before(); ?>
        <footer id="footer">
        	<?php wpex_hook_footer_top(); ?>
			<div id="copyright"><?php echo wpmp_get_single_setting( 'footer-text' ) ?>
			<br /><a href="<?php echo add_query_arg( 'wp-mobile-switch', 'desktop' ) ?>" title="<?php echo wpmp_get_single_setting( 'switch-to-desktop-text' ) ?>" rel="nofollow"><?php echo wpmp_get_single_setting( 'switch-to-desktop-text' ) ?></a></div>
            <?php wpex_hook_footer_bottom(); ?>
        </footer><!-- /footer -->
        <?php wpex_hook_footer_after(); ?>
    </div><!-- /footer-wrap -->
</div><!-- /wrap -->
<?php wp_footer(); // Footer hook, do not delete, ever ?>
</body>
</html>