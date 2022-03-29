<?php
/*
 * Template Name: Company Culture
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
<section class="awrd-hed">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hed-bed">
                    <h1><?php the_title(); ?></h1>
                    <div>
                        <a href="<?php echo get_home_url(); ?>">Home</a>    >    <?php the_title(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="acr-ld-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="acr-ld">
                    <h2><?php the_field('sub_title')?></h2>
                    <?php the_content(); ?>
                </div>
                <div class="count-div">
                    <?php
                        if(have_rows('counts')):
                            while(have_rows('counts')): the_row();
                    ?>
                    <div>
                        <span class="count" ><?php the_sub_field('count'); ?></span>
                        <p><?php the_sub_field('title'); ?></p>
                    </div>
                    <?php
                            endwhile;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="acr-img">
                    <img src="<?php the_field('main_image')?>">
                </div>
            </div>
        </div>
        <div class="row emply-row">
            <div class="col-lg-6 col-md-12">
            <?php
            if(have_rows('benefits')):
                while(have_rows('benefits')): the_row();
                    ?>
                <div class="emply">
                    <h4><?php the_sub_field('title'); ?></h4>
                    <p><?php the_sub_field('description'); ?></p>
                </div>
            <?php
                endwhile;
            endif;
            ?>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="emply-img">
                    <img src="<?php the_field('benefit_image')?>">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="">
    <div class="gry-l">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6><?php the_field('career_title')?></h6>
                    <p><?php the_field('carreer_description')?></p>
                    <div>
                        <a href="<?php the_field('career_page_link')?>">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gry-d">

    </div>
</section>
    <?php
endwhile;
get_footer();
?>