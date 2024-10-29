<?php
/*
Plugin Name: B-Banner Slider
Description: Plugin for banner slideshow
Author: Bikram Joshi
version: 1.1
Author URI: http://bikramjoshii.blogspot.in/
*/
global $wpdb;
define('BBS_PLUGIN_DIR', dirname(__FILE__));
define('BBS_PLUGIN_URL', WP_PLUGIN_URL."/".basename(dirname(__FILE__)));
define('BBS_INCLUDE_PATH', BBS_PLUGIN_URL."/includes");
define('BBS_IMAGE_PATH', BBS_INCLUDE_PATH."/images");
define('BBS_CSS_PATH', BBS_INCLUDE_PATH."/css");
define('BBS_JS_PATH', BBS_INCLUDE_PATH."/js");
define('BBS_IMAGES_TABLE', $wpdb->prefix.'bbanner_slider_images');
define('BBS_INSTALL_FILE', BBS_PLUGIN_DIR.'/install.php');
define('BBS_UPLOAD_DIR', WP_CONTENT_DIR.'/uploads/bbanner-slider/');
define('BBS_UPLOAD_URL', WP_CONTENT_URL.'/uploads/bbanner-slider/');

register_activation_hook(__FILE__, 'bbs_activation');
require_once BBS_INSTALL_FILE;

add_action('admin_menu', 'admin_menu');
function admin_menu() {
	$filename = basename(dirname(__FILE__));
	$pages[] = add_menu_page(__('B-Banner Slider'), __('B-Banner Slider'), 0, $filename.'/bbanner_slider.php', 'bbs_list_banner',BBS_IMAGE_PATH."/b_16x16.png");
	$pages[] = add_submenu_page(__FILE__, __('Manage Banners'), __('Manage Banners'), 0, $filename.'/bbanner_slider.php', 'bbs_list_banner');
	$pages[] = add_submenu_page(__FILE__, __('Settings'), __('Settings'), 0, $filename.'/settings.php', 'bbs_settings');
	foreach($pages as $page) :
		add_action('admin_print_scripts-'.$page, 'bbs_scripts');
	endforeach;
}

function bbs_list_banner() { include 'list_banner.php'; }
function bbs_settings() { include 'settings.php'; }

add_action('wp_enqueue_scripts', 'bbs_scripts');
function bbs_scripts() {
	wp_enqueue_style('bbs-styles', BBS_CSS_PATH."/style.css", array(), '1.0');
	wp_enqueue_style('bbs-wt_rotator', BBS_CSS_PATH."/wt-rotator.css", array(), '1.0');
	wp_enqueue_script('bbs-jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	wp_enqueue_script('bbs-wt_rotator', BBS_JS_PATH.'/jquery.wt-rotator.min.js', array('jquery'), '1.7.2', true);
	wp_enqueue_script('bbs-scripts', BBS_JS_PATH.'/scripts.js', array('jquery'), '1.7.2', true);
}

function bbanner_slider() {
	global $wpdb;
	$rows = $wpdb->get_results("SELECT id, image_name FROM ".BBS_IMAGES_TABLE." WHERE visible=1 ORDER BY id DESC");
	echo '<div class="panel">
  			<div class="container">
  	        	<div class="wt-rotator">
    		        <div class="screen">
    		            <noscript><img src="images/triworks_abstract17.jpg"/></noscript>
    		        </div>
    		        <div class="c-panel">
    		            <div class="buttons">
    		               <div class="prev-btn"></div>
   			               <div class="play-btn"></div>
    		               <div class="next-btn"></div>        
    		            </div>
    		            <div class="thumbnails"><ul>'; ?>
                        <?php foreach($rows as $row) : ?>
							<li><a href="<?php echo BBS_UPLOAD_URL.$row->image_name; ?>"><img src="<?php echo BBS_UPLOAD_URL.$row->image_name; ?>" height="70" /></a></li>
						<?php endforeach; ?>
					<?php echo '</ul>
                		</div>
            		</div>
        		</div>
  			</div>
		</div>
		<div style="height: 20px;"></div>';
}

add_action('wp_footer', 'wt_rotator_script', 100);
function wt_rotator_script() { ?>
	<script type="text/javascript">
		function container_rotator(banner_width) {
			var $container = jQuery(".container");		
			$container.wtRotator({width:banner_width, height:<?php echo get_option('bbsbanner_height'); ?>,button_width:<?php echo get_option('bbsbutton_width'); ?>,button_height:<?php echo get_option('bbsbutton_height'); ?>,button_margin:<?php echo get_option('bbsbutton_margin'); ?>,auto_start:<?php echo get_option('bbsauto_start'); ?>,delay:<?php echo get_option('bbsdelay'); ?>,transition:"<?php echo get_option('bbstransition'); ?>",transition_speed:<?php echo get_option('bbstransition_speed'); ?>,block_size:<?php echo get_option('bbsblock_size'); ?>,vert_size:55,horz_size:50,cpanel_align:"BR",timer_align:"<?php echo get_option('bbstimer_align'); ?>", display_thumbs:<?php echo get_option('bbsdisplay_thumbs'); ?>, display_dbuttons:<?php echo get_option('bbsdisplay_dbuttons'); ?>, display_playbutton:<?php echo get_option('bbsdisplay_playbutton'); ?>, tooltip_type:"image",display_numbers:<?php echo get_option('bbsdisplay_numbers'); ?>,display_timer:<?php echo get_option('bbsdisplay_timer'); ?>,mouseover_pause:<?php echo get_option('bbsmouseover_pause'); ?>,cpanel_mouseover:false,text_mouseover:<?php echo get_option('bbstext_mouseover'); ?>,text_effect:"<?php echo get_option('bbstext_effect'); ?>",text_sync:true,shuffle:<?php echo get_option('bbsshuffle'); ?>,block_delay:25,vstripe_delay:73,hstripe_delay:183});
		}
		container_rotator('<?php echo get_option('bbsbanner_width'); ?>');
	</script>
<?php } ?>