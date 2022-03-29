<!DOCTYPE html>
<html lang="en">
<head>
		

    <title>FineFinish | <?php echo (is_archive())? get_archive_post_type() :  get_the_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/fav.png" type="image/gif" sizes="16x16"> 
    <?php wp_head(); ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body <?php body_class(); ?>>
<header>
<div class="top-navbar-des">
 <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="h1-single-top-block text-center">
              <i class="fa fa-phone" aria-hidden="true"></i><span> +94 776 56 56 56</span>
            </div>

            <div class="h1-single-top-block text-center">
              <i class="fa fa-envelope-o" aria-hidden="true"></i>
              <a href="mailto:office@example.com" target="_top"> info@finefinisheng.com</a>
            </div>
            
          </div>
          <div class="nav-serch-area">
            <div id="inline-popups" class="form-inline my-2 my-lg-0">
              <!-- <a class="header-search" href="#test-popup" data-effect="mfp-zoom-in">
                <i class="fa fa-search" aria-hidden="true"></i>
              </a> -->
           
              <!-- <div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
                <form>
                  <div class="form-group">
                    <label for="Search">Search</label>
                    <input type="text" class="form-control" id="Search" placeholder="Enter Search Key">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div> -->
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="h1-social-media">
              <ul type="none" style="margin-bottom: 0rem;">
                <li><a href="https://www.facebook.com/finefinisheng"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/finefinisheng"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.linkedin.com/company/finefinish-engineering-pvt-ltd/"><i class="fa fa-linkedin"></i></a></li>
                <!-- <li><a href="#"><i class="fa fa-vine"></i></a></li> -->
				  <button class="get_quote">
					  <a href="https://www.finefinisheng.com/contact-us/" class="get_quote btn text-light my-2 my-sm-0">Get A Quote</a>
				  </button>
                
              </ul>
              
            </div>
          </div>
        </div>
      </div>
</div>
    <div class="container-fluid" style="padding-left: 5%; padding-right: 5%;">
        <div class="row">
            <div class="col-md-12">
                <div class="logo stickmenu_invert">
                    <a href="<?php echo home_url(); ?>">
                        <?php
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        if ( has_custom_logo() ) {
                            echo '<img src="'. esc_url( $logo[0] ) .'" alt="'.get_bloginfo( 'name' ).'">';
                        } else {
                            echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
                        }
                        ?>
                    </a>
                </div>
				<div id="custom_nav_bar">
					<?php
					wp_nav_menu( array( 
						'theme_location' => 'my-custom-menu', 
						'container_class' => 'custom-menu-class' ) ); 
					?>
				</div>
               <!-- <div class="top-cont stickmenu_invert">
                    <a href="<?php the_field('location', 'option'); ?>"><img src="<?php echo ASSETS_IMAGE; ?>pin.png"></a>
                    <a href="<?php the_field('email', 'option'); ?>"><img src="<?php echo ASSETS_IMAGE; ?>msg.png"></a>
                </div>-->
           <div class="mobile-menu-ext menu"> 
                    <div class="mnu-btn stickmenu_invert">
                        <span></span>
                        <span></span>
                        <span></span>
                        <p>menu</p>
                    </div>
                    <div class="sid-menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header-menu',
                        'container' => false,
                        'container_class' => '',
                        'menu_id' => 'menu', ) );
                    ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</header>