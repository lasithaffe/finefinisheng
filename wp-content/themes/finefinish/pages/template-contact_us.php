<?php
/*
 * Template Name: Contact us
 * */
get_header();?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</div>
</section>
<?php
    while(have_posts()): the_post();
?>
        <section class="sub-banner" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hed-bed">
                            <h1><?php the_title(); ?></h1>
                            <h3><?php the_field('sub_title')?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="gary-dark">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="inquiries">
                            <h4>inquiries</h4>
                            <p><?php the_content(); ?></p>
                        </div>
                        
                            <?php echo do_shortcode('[contact-form-7 id="252" title="Contact Us"]'); ?>
                   
                    </div>
                </div>
            </div>
        </section>
        <?php
            if(have_rows('location')):
                while(have_rows('location')): the_row();
        ?>

        <section id="locations">
            <div class="container-fluid">
                <?php
                    if(get_row_index() % 2):
                ?>
                <div class="row">
                    <div class="col-md-6 marg-rm gt-h">
                        <div class="cont-col">
                            <div class="cont-box cont-left">
                                <h3><?php the_sub_field('title'); ?></h3>
                                <p><?php the_sub_field('description'); ?></p>
                                <ul>
                                    <li class="adress"><?php the_sub_field('address'); ?></li>
                                    <li class="tel"><?php the_sub_field('contact_number'); ?></li>
                                    <li class="mail"><a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 marg-rm set-h oder">
                        <div class="cont-gary">
                            <?php echo get_sub_field('google_map')?>
                        </div>
                    </div>
                </div>
                <?php
                    else:
                ?>
                <div class="row">
                    <div class="col-md-6 marg-rm set-2h order-lg-1 order-md-2 order-sm-2 order-2">
                        <div class="cont-gary con-right">
                            <?php echo get_sub_field('google_map')?>
                        </div>
                    </div>
                    <div class="col-md-6 marg-rm get-2h order-lg-2 order-md-1 order-sm-1 order-1">
                        <div class="cont-col">
                            <div class="cont-box cont-right">
                                <h3><?php the_sub_field('title'); ?></h3>
                                <p><?php the_sub_field('description'); ?></p>
                                <ul>
                                    <li class="adress"><?php the_sub_field('address'); ?></li>
                                    <li class="tel"><?php the_sub_field('contact_number'); ?></li>
                                    <li class="mail"><a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </section>

<?php
                endwhile;
        endif;
endwhile;
get_footer();
?>
