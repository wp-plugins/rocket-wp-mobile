<?php
/**
 * This file is used for your gallery post entry
 * @package Thoughts WordPress Theme
 * @since 1.0
 * @author AJ Clarke : http://wpexplorer.com
 * @copyright Copyright (c) 2012, AJ Clarke
 * @link http://wpexplorer.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */  
?>

<?php wpex_hook_content_before(); ?>
<article <?php post_class('post-entry clearfix'); ?>> 
<?php wpex_hook_content_top(); ?> 

	<script type="text/javascript">
    jQuery(function($){
        jQuery(window).load(function() {
            $("#gallery-slider").flexslider({
                animation: 'slide',
                slideshow: true,
                controlNav: false,
                prevText: '<span class="wpex-icon-chevron-left"></span>',
                nextText: '<span class="wpex-icon-chevron-right"></span>',
                smoothHeight: true,
                start: function(slider) {
                    slider.container.click(function(e) {
                        if( !slider.animating ) {
                            slider.flexAnimate( slider.getTarget('next') );
                        }
                    
                    });
                }
            });
        });
    });
    </script>
        
    <div class="flexslider-container">
        <div id="gallery-slider" class="flexslider">
            <ul class="slides">
                <?php
                // Get Attachments
                $wpex_single_gallery_attachments = get_posts(
                array(
                    'orderby' => 'menu_order',
                    'post_type' => 'attachment',
                    'post_parent' => get_the_ID(),
                    'post_mime_type' => 'image',
                    'post_status' => null,
                    'posts_per_page' => -1
                )
            ); 
                // Loop through attachments
                foreach ( $wpex_single_gallery_attachments as $wpex_single_gallery_attachment ) :
                
                // Include image in slider/gallery
                if( get_post_meta($wpex_single_gallery_attachment->ID, 'be_rotator_include', true) !== '1' ) {
                ?>
                <li class="slide"><img src="<?php echo aq_resize( wp_get_attachment_url( $wpex_single_gallery_attachment->ID, 'full' ),  wpex_img( 'blog_width' ), wpex_img( 'blog_height' ), wpex_img( 'blog_crop' ) ); ?>" alt="<?php echo the_title(); ?>" /></li>
                <?php } endforeach; ?>
            </ul><!-- /slides -->
        </div><!-- /flexslider -->
    </div><!-- /flexslider-container -->
    
	<?php
	/**
	 * Single Posts
	 * @since 1.0
	 */
	if ( is_singular() && is_main_query() ) { ?>
    
        <div class="post-entry-text clearfix">
            <header>
                <h1><?php the_title(); ?></h1>
                <ul class="post-entry-meta">
                    <li><?php echo get_the_date(); ?></li>
                    <li>By: <?php the_author_posts_link(); ?></li>
                </ul>
            </header>
            <div class="post-entry-content">
            	<?php the_content(''); ?>
            </div><!-- /post-entry-content -->
            <footer class="post-entry-footer">
                <p><?php _e('Categorized','wpex'); ?>: <?php the_category(' - '); ?></p>
                <p><?php _e('Tagged','wpex'); ?>: <?php the_tags('',' - ', ''); ?></p>
            </footer><!-- /post-entry-footer -->
            <?php comments_template(); ?>
        </div><!-- /post-entry-text -->
    
    <?php
	/**
	 * Entries
	 * @since 1.0
	 */
	} else { ?>
    
        <div class="post-entry-text clearfix">
            <header>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <ul class="post-entry-meta">
                    <li><?php echo get_the_date(); ?></li>
                    <li>By: <?php the_author_posts_link(); ?></li>
                </ul>
            </header>
            <div class="post-entry-content">
            	<?php the_content(''); ?>
            </div><!-- /post-entry-content -->
            <footer class="post-entry-footer">
                <?php if(comments_open()) { ?><?php comments_popup_link(__('0 Comments', 'wpex'), __('1 Comment', 'wpex'), __('% Comments', 'wpex'), 'comments-link' ); ?><?php } ?><span class="wpex-icon-minus"></span><a href="<?php the_permalink(); ?>" title="<?php _e('read more','wpex'); ?>"><?php _e('read more','wpex'); ?> &rarr;</a>
            </footer><!-- /post-entry-footer -->
        </div><!-- /post-entry-text -->
        
    <?php } ?>
    
<?php wpex_hook_content_bottom(); ?>
</article><!-- /post-entry -->
<?php wpex_hook_content_after(); ?>