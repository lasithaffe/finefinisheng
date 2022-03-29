<?php
/*
 * Single Media Page
 * */
get_header();
?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</div>
</section>
<?php
while(have_posts()): the_post();
    ?>
    <section class="about-banner" style="background-image: url(<?php the_field('banner_image'); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="abu-left">
                        <h1><?php the_field('sub_title'); ?></h1>
                        <h2><?php the_title(); ?></h2>
                    </div>
                </div>
                <div class="col-md-5">
                </div>
            </div>
        </div>
    </section>
    <section class="abou-con">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about-cont">
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img">
                        <img src="<?php the_post_thumbnail_url(); ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
endwhile;
get_footer();
?>