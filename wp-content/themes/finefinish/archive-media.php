<?php
/*
 * Media Archive Page
 * */
get_header();?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</section>
<?php
$post_type = get_archive_post_type();

?>
<section class="awrd-hed">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hed-bed">
                    <h1><?php echo post_type_archive_title(); ?></h1>
                    <div>
                        <a href="<?php echo home_url(); ?>">Home</a>    >    <?php echo post_type_archive_title(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="">
<?php
if (have_posts()) :
?>
    <div class="owl-epecialized">
        <div class="owl-carousel owl-theme" id="owl-epecialized">
<?php
    while (have_posts()) : the_post();
            ?>
            <div class="item">
                <div class="mid-cnc" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
                    <div class="mid-inn">
                        <span><?php the_field('sub_title'); ?></span>
                        <h3><?php the_title(); ?></h3>
                        <div>
                            <?php echo mb_strimwidth(get_the_content(), 0, 150, '..'); ?>
                            <a href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
<?php
    endwhile;
?>

        </div>
    </div>
<?php
    endif;
?>
</section>
<section class="os-sec">
    Other Services
</section>

<?php
get_footer();
?>