<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Video gallery and Player
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="wrap vgap-wrap">
	<h2><?php _e( 'How It Works', 'html5-videogallery-plus-player' ); ?></h2>
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.vgap-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.vgap-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
		.upgrade-to-pro{font-size:18px; text-align:center; margin-bottom:15px;}
		.wpos-copy-clipboard{-webkit-touch-callout: all; -webkit-user-select: all; -khtml-user-select: all; -moz-user-select: all; -ms-user-select: all; user-select: all;}
		.wpos-new-feature{ font-size: 10px; margin-left:3px;  color: #fff; font-weight: bold; background-color: #03aa29; padding:1px 4px; font-style: normal; margin-left: 3px;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
			
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<div class="postbox-header">
									<h2 class="hndle">
										<span><?php _e( 'How It Works - Display and shortcode', 'html5-videogallery-plus-player' ); ?></span>
									</h2>
								</div>
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Geeting Started with Video Gallery', 'html5-videogallery-plus-player'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin create a "Video Gallery" in WordPress menu section', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-2: Click on "Video Gallery --> Add new" ', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-3: Add Video title, link, and video poster image as a featured image.', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-4: You can also create the categories under "Video Gallery--> category". Asign the video under respective category and use category shortcode to display multiple video galleries. ', 'html5-videogallery-plus-player'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'html5-videogallery-plus-player'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: Craete a page say Video gallery OR videos', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-2: Add the bellow shortcode OR shortcode from "Video Gallery--> category" ', 'html5-videogallery-plus-player'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'html5-videogallery-plus-player'); ?>:</label>
												</th>
												<td>
													<span class="wpos-copy-clipboard vgap-shortcode-preview">[sp_html5video]</span> – <?php _e('Display Album Gellery and Video Player in a page (list view and grid view)', 'html5-videogallery-plus-player'); ?>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->

							<div class="postbox">
								<div class="postbox-header">
									<h2 class="hndle">
										<span><?php _e( 'Gutenberg Support', 'html5-videogallery-plus-player' ); ?></span>
									</h2>
								</div>
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('How it Work', 'html5-videogallery-plus-player'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Go to the Gutenberg editor of your page.', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-2. Search "Video Gallery" keyword in the Gutenberg block list.', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-3. Add any block of Video Gallery and you will find its relative options on the right end side.', 'html5-videogallery-plus-player'); ?></li>
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->

							<div class="postbox">
								<div class="postbox-header">
									<h2 class="hndle">
										<span><?php _e( 'Need Support?', 'html5-videogallery-plus-player' ); ?></span>
									</h2>
								</div>
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<td>
													<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'html5-videogallery-plus-player'); ?></p> <br/>
													<a class="button button-primary" href="https://docs.wponlinesupport.com/video-gallery-and-player/" target="_blank"><?php _e('Documentation', 'html5-videogallery-plus-player'); ?></a>
													<a class="button button-primary" href="https://demo.wponlinesupport.com/video-gallery-and-player-demo/" target="_blank"><?php _e('Demo for Designs', 'html5-videogallery-plus-player'); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->

							<div class="postbox">
								<div class="postbox-header">
									<h2 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'html5-videogallery-plus-player' ); ?></span>
									</h2>
								</div>
								<div class="inside">
									<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://wordpress.org/support/plugin/html5-videogallery-plus-player/reviews/" target="_blank">5 stars!</a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
				
				<!--Upgrad to Pro HTML -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">

								<h3 class="hndle">
									<span><?php _e( 'Upgrate to Pro', 'html5-videogallery-plus-player' ); ?></span>
								</h3>
								<div class="inside">
									<ul class="wpos-list">
										<li>20+ Designs</li>
										<li>Grid View <br /> <img style="width:100%;" src="<?php echo WP_HTML5VP_URL; ?>assets/images/video-gallery-grid.jpg"></li>
										<li>Slider/Carousel View <br /> <img style="width:100%;" src="<?php echo WP_HTML5VP_URL; ?>assets/images/video-gallery-slider.jpg"></li>
										<li>Slider/Carousel with center mode <br /> <img style="width:100%;" src="<?php echo WP_HTML5VP_URL; ?>assets/images/video-gallery-slider-center-mode.jpg"></li>
										<li>Multiple display with category</li>
										<li>WP Templating Features.</li>
										<li>Gutenberg Block Supports.</li>
										<li>WPBakery Page Builder Supports</li>
										<li>Elementor, Beaver and SiteOrigin Page Builder Support. <span class="wpos-new-feature">New</span></li>
										<li>Divi Page Builder Native Support. <span class="wpos-new-feature">New</span></li>
										<li>Editor support</li>
										<li>Drag and drop custom ordering</li>
										<li>Responsive</li>
										<li>Popup gallery slider</li>
									</ul>
									<div class="upgrade-to-pro">Gain access to <strong>Video Gallery and Player</strong> included in <br /><strong>Essential Plugin Bundle</div>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/wp-plugin/video-gallery-player/?ref=WposPratik&utm_source=WP&utm_medium=Video&utm_campaign=Upgrade-PRO" target="_blank"><?php _e('Go Premium ', 'html5-videogallery-plus-player'); ?></a>	
									<p><a class="button button-primary wpos-button-full" href="https://demo.wponlinesupport.com/prodemo/video-gallery-and-player-pro-demo/" target="_blank"><?php _e('View PRO Demo ', 'html5-videogallery-plus-player'); ?></a>			</p>								
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
</div>