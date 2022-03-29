<?php
/*
 * Single Industries Page
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
    <section class="sub-banner indus" style="background-image: url(<?php the_field('banner_image'); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="hed-bed">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="ind-con">
                        <p><?php the_content(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="btn-div">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <a href="#about" class="btn-ins">About</a>
                    <a href="#key-features" class="btn-ins">Key Fetures</a>
                    <a href="#our-clients" class="btn-ins">Our Clients</a>
                </div>
                <div class="col-md-5">
                    <a href="" class="btn-red">About</a>
                </div>
            </div>
        </div>
    </section>
    <section id="about">
        <div class="container relative">
            <div class="slnt-div">
                About
            </div>
            <div class="row slnt-line">
                <div class="col-md-7">
                    <div class="wcu">
                        <?php the_field('about_description'); ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="wcu-img">
                        <img src="<?php the_field('about_image'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        if(have_rows('key_feautures')):
    ?>
    <section id="key-features">
        <div class="container relative">
            <div class="slnt-div key_fts" >
                Key Features
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="key_features"> <h4>Key Features</h4></div>
                </div>
            </div>
            <div class="row">
            <?php
                    while(have_rows('key_feautures')): the_row();
                        $key = get_sub_field('feature');
            ?>
                <div class="col-md-4">
                    <div class="feature">
                        <img src="<?php echo $key['background_image']; ?>">
                        <div>
                            <img class="hove" src="<?php echo $key['icon']; ?>">
                            <img class="hove-n" src="<?php echo $key['icon_hover']; ?>">
                            <h4><?php echo $key['title']; ?></h4>
                            <p><?php echo $key['description']; ?></p>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
            ?>
            </div>
        </div>
    </section>
    <?php
        endif;

    $posts = have_rows('projects');
    if( $posts ):
    ?>

    <?php
        while(have_rows('projects')): the_row();
                if(get_row_index() % 2){
    ?>

    <section class="back-d scl" id="our-clients">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-lg-1 order-md-2 order-sm-2 order-2">
                    <div class="our-clnt" data-aos="fade-left" data-aos-delay="1500">
                        <?php
                            if(get_sub_field('logo')):
                        ?>
                            <img src="<?php echo get_sub_field('logo'); ?>">
                        <?php
                             endif;
                        ?>
                        <h4><?php echo get_sub_field('title'); ?></h4>
                        <p><?php echo mb_strimwidth(get_sub_field('description'), 0, 200, '..'); ?></p>
                        <?php if( get_sub_field('link')): ?>
                        <a href="<?php get_sub_field('link'); ?>">Read more</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-md-1 order-sm-1 order-1" data-aos="zoom-in-down" data-aos-duration="1000">
                    <div class="clnt-img">
                        <img src="<?php echo get_sub_field('image'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
                }else{
    ?>
    <section class="back-d scl" id="our-clients">

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="clnt-img" data-aos="zoom-in-down" data-aos-duration="1500">
                        <img src="<?php echo get_sub_field('image'); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="our-clnt right" data-aos="fade-right" data-aos-delay="1000">
                        <?php ;
                        if(get_sub_field('logo')):
                            ?>
                            <img src="<?php echo get_sub_field('logo'); ?>">
                            <?php
                        endif;
                        ?>
                        <h4 ><?php echo get_sub_field('title'); ?></h4>
                        <p><?php echo mb_strimwidth(get_sub_field('description'), 0, 200, '..'); ?></p>
                        <?php if( get_sub_field('link')): ?>
                        <a href="<?php get_sub_field('link'); ?>">Read more</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <?php
                }
            endwhile;;
        endif;


    ?>

    <section class="ind-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="questions ind">
                        <h4>Interested in what we have done ?
                            <span>Let’s Start<br> a project</span>
                        </h4>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row from-ind">
                        <p>Fill the quick inquiry form below so that one of our agent can gent back to you within next 48 hours</p>
                        <?php echo do_shortcode('[contact-form-7 id="5" title="Inquiry Form"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
endwhile;
get_footer();
?>