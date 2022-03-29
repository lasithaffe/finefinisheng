=== Video gallery and Player ===
Contributors: wponlinesupport, anoopranawat, pratik-jain
Tags: video gallery, video, HTML5 video, video.js, youtube video gallery, vimeo video gallery, youtube video gallery with popup,  youtube gallery, youtube player, magnific Popup, vimeo video gallery, HTML5 video player, HTML5 video gallery, responsive, wordpress responsive video gallery, wponlinesupport  
Requires at least: 4.0
Tested up to: 5.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easy to add and display your HTML5, YouTube, Vimeo vedio gallery with Magnific Popup to your website. Also work with Gutenberg shortcode block. 

== Description ==

This plugin add a responsive HTML5, YouTube, Vimeo vedio gallery with Magnific Popup to your  WordPress website. Display video gallery in grid view(1,2,3,4) etc. You can also use category id to create multiple vedio galleries.

Check [Demo and Features](https://demo.wponlinesupport.com/video-gallery-and-player-demo/) for additional information.

The plugin adds a Video gallery tab to your admin menu, which allows you to enter Video Title and Video source items just as you would regular posts.

**Also work with Gutenberg shortcode block.**

= Gallery Options: = 
* Create a YouTube gallery page.
* Create a Vimeo gallery page.
* Create a HTML5 Video gallery page.

= Display video in a Popup =
* Added Magnific Popup
 
With this video gallery plugin, you can create galleries from your youtube, vimeo and HTML5 videos. The process of creating a video gallery only takes a few minutes and created gallery can be displayed on any page or post by means of WordPress shortcode.
 
Now just create a new page and add this short code to your page:

<code>[sp_html5video] </code> 

You can also use PHP code 

<code> <?php echo do_shortcode('[sp_html5video]'); ?></code> 

directly to your template file.

= Shortcode parameters: =

<code>[sp_html5video]</code>

* **limit:**
[sp_html5video limit="5"] ( ie Display 5 items on your website )
* **Grid:**
[sp_html5video grid="2"]( ie Display your video gallery by Grid view - Number of column you want to create)
* **Display by category**
[sp_html5video category="category_ID"] ( ie Display by their category ID )
* **Display by post**
[sp_html5video post="post_ID"] ( ie Display by post ID )
* **popup_fix:**
[sp_html5video popup_fix="true"] ( ie Popup setting ie fix or scroll with page. Default value is "false". Values are "true OR false" )


= Features include: =
* Create unlimited galleries with category shortcode.
* Also work with Gutenberg shortcode block.
* Fully Responsive
* Create a Video gallery page.
* Add a Video player to your page.
* Create multiple vedio galleries with category id.
* Display video gallery in grid view(1,2,3,4) etc
* Simple plugin so that you can customize it as per your need.
* Easy to configure
* Smoothly integrates into any theme

= PRO Features : =
> <strong>Premium Version</strong><br>
>
> * Added 2 shortcodes with various parameters.
> * [video_gallery] – Grid Shortcode
> * [video_gallery_slider] – Slider Shortcode
> * 20 Predefined designs.
> * WP Templating Features. 
> * Gutenberg Block Supports.
> * WPBakery Page Builder Support
> * Elementor, Beaver and SiteOrigin Page Builder Support (New).
> * Divi Page Builder Native Support (New).
> * Display videos in a grid view.
> * Display video with title and description.
> * Display video in slider view.
> * Slider RTL support.
> * Display video categories wise.
> * Drag & Drop features to display video in your desired order.
> * Add your custom css via plugin setting page.
> * Display HTML 5, Youtube, Vimeo and Dailymotion video.
> * 100% Multilanguage.
> * Fully Responsive.
>
> View [PRO DEMO and Features](https://www.wponlinesupport.com/wp-plugin/video-gallery-player/) for additional information.
>

= Privacy & Policy =
* We have also opt-in e-mail selection , once you download the plugin , so that we can inform you and nurture you about products and its features.

== Installation ==

1. Upload the 'html5_videogallery_and_player' folder to the '/wp-content/plugins/' directory.
2. Activate the 'HTML5 Video Player and Video gallery'  plugin through the 'Plugins' menu in WordPress.
3. Add videos under Video gallery tab.
4. Add a new page and add this short code <code>[sp_html5video] </code>.
5. Add php code directly to your template file <code> <?php echo do_shortcode('[sp_html5video]'); ?> </code> inside php code. 

### How to add video gallery in a page
Create a page with any name and enter 
<code>[sp_html5video]</code> shortcode in to your page 
OR  
<code> <?php echo do_shortcode('[sp_html5video]'); ?> </code> to your template file.

== Screenshots ==

1. Video gallery tab after plugin activation
2. Meta boxes for adding video link
3. Poster for video 
4. Category shortcode
5. Grid view
6. Popup view
7. Also work with Gutenberg shortcode block.

== Changelog ==

= 2.4 (29, Oct 2020) =
* [*] Update - Regular plugin maintenance. Updated readme file.
* [+] New - Click to copy the shortcode.
* [+] Added - Added our other Popular Plugins under Video Gallery --> Install Popular Plugins From WPOS. This will help you to save your time during creating a website.
* [*] Tested up to latest version of WordPress.

= 2.3.5 (14, July  2019) =
* [*] Follow WordPress Detailed Plugin Guidelines for Offload Media and Analytics Code.

= 2.3.4 (31, Dec  2019) =
* [*] Fixed HTML5 video lightbox background issue. Added white background.
* [*] Replaced wp_reset_query() with wp_reset_postdata() in both shortcodes.
* [+] Added esc_url() where needed.

= 2.3.3 (14, Sep  2019) =
* [*] Tested with latest version of WordPress.

= 2.3.2 (13, Feb 2019) =
* [*] Minor change in Opt-in flow.

= 2.3.1 (26, Dec 2018) =
* [*] Update Opt-in flow.

= 2.3 (07, Dec 2018) =
* [*] Tested with WordPress 5.0 and Gutenberg.
* [*] Fixed some CSS issues.

= 2.2.3 (07, June 2018) =
* [*] Follow some WordPress Detailed Plugin Guidelines.

= 2.2.2 (Date 06 April, 2018) =
* [*] Fixed issue with HTML video player when closing the popup.
* [*] Fixed issue with HTML video player when Multiple shortcode on a page

= 2.2 (Date 22 March, 2018) =
* Tested up to WP 4.9.4
* Fixed some CSS issue

= 2.1.3 (Date 30 Jan, 2017) =
* Tested up to WP 4.7.2
* [+] Added Zoom Animation on popup open
* Fixed some CSS issue

= 2.1.2 (Date 05 Dec, 2016) =
* Tested up to WP 4.6.1
* Added string translation 

= 2.1.1 (Date 27 Oct, 2016) =
* [+] Added "How to work" menu tab.
* [-] Removed Pro design tab.
* Improved category shortcode display column code.

= 2.0.1 (Date 18 July, 2016) =
* Resolved multiple shortcode popup issue.
* Optimized JS Performane.
* Improved category shortcode display column code.
* Added PRO design page.

= 2.0 (Date 18 July, 2016) =
* Fixed some css issues
* Fixed Play button popup open

= 1.1.1 (Date 7 july, 2016) =
* Fixed Popup and responsive bug

= 1.1 (Date 7july 2016) =
* Added Magnific Popup
* Added grid for video gallery
* Added latest video.js and css
* Added better design
* Added meta box for adding video links
* Remove setting page

= 1.0 =
* Initial release.