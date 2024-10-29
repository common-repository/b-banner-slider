<?php
function bbs_activation() {
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	if($wpdb->get_var("show table like '".BBS_IMAGES_TABLE."'") != BBS_IMAGES_TABLE) {
		$images_table = "CREATE TABLE ".BBS_IMAGES_TABLE." (
  						`id` int(9) NOT NULL AUTO_INCREMENT,
  						`image_name` varchar(155) NOT NULL,
  						`visible` tinyint(1) NOT NULL,
						`description` text NOT NULL,
						`created_at` TIMESTAMP NOT NULL,
  						PRIMARY KEY (`id`)
						) ENGINE = MyISAM;";
		dbDelta($images_table);
	}
	
	if(! file_exists(BBS_UPLOAD_DIR) && mkdir(BBS_UPLOAD_DIR, 0777, true) ): endif;
	add_option('bbsbanner_width', '940');
	add_option('bbsbanner_height', '340');
	add_option('bbsbutton_width', '24');
	add_option('bbsbutton_height', '24');
	add_option('bbsbutton_margin', '5');
	add_option('bbsauto_start', 'true');
	add_option('bbsdelay', '5000');
	add_option('bbstransition', 'fade');
	add_option('bbstransition_speed', '1000');
	add_option('bbsblock_size', '75');
	add_option('bbstimer_align', 'top');
	add_option('bbsdisplay_thumbs', 'true');
	add_option('bbsdisplay_dbuttons', 'true');
	add_option('bbsdisplay_playbutton', 'true');
	add_option('bbsdisplay_numbers', 'true');
	add_option('bbsdisplay_timer', 'true');
	add_option('bbsmouseover_pause', 'false');
	add_option('bbstext_mouseover', 'false');
	add_option('bbstext_effect', 'fade');
	add_option('bbsshuffle', 'false');	
}