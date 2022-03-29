<?php
/*
 * Template Name: Awards
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
                        <a href="<?php echo home_url(); ?>">Home</a>     >    Awards
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="gary">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-9">
            <div class="awd-main">
                <?php
                    if(have_rows('time_line')):
                        while(have_rows('time_line')) : the_row();
                ?>
                <div class="awd-hed">
                    <?php
                        if(get_row_index() == 1){
                    ?>
                    <p><?php the_content(); ?></p>
                    <?php
                        }else{
                    ?>
                            <div class="sep-lin"></div>
                    <?php
                        }
                    ?>
                    <div class="year">
                        <?php the_sub_field('year'); ?>
                    </div>
                </div>
                       <?php
                            while(have_rows('awards')): the_row();
                        ?>
                        <div class="awd-lis">
                            <div class="mont">
                                <p><?php the_sub_field('month'); ?></p>
                                <span></span>
                            </div>
                            <div class="awd-cont">
                                <img src="<?php the_sub_field('image'); ?>">
                                <div>
                                    <h4><?php the_sub_field('title'); ?></h4>
                                    <p><?php the_sub_field('description'); ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                            endwhile;
                        endwhile;
                    endif
                ?>

            </div>
        </div>
    </div>
</section>
    <?php
endwhile;
get_footer();
?>