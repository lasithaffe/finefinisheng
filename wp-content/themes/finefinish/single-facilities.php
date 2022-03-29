<?php
    get_header();?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</div>
</section>
<?php
    if(have_posts()):
    while(have_posts()): the_post()
?>
<section class="about-banner" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="prdit-top fdclnt-top">
                    <h2><?php the_title(); ?></h2>
                    <div class="pr-clnt fdclnt">
                        <div>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="the-idea">
    <div class="container">
        <?php
            if(have_rows('top_blocks')):
            while(have_rows('top_blocks')): the_row();
                if(get_row_index()%2):
        ?>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="the-idea-cont brif-cont">
                    <?php the_sub_field('description'); ?>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="main-pl Arc-Welding">
                    <img src="<?php the_sub_field('image'); ?>">
                </div>

            </div>
        </div>
        <?php
                else:
        ?>
        <div class="row mt-70">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="main-pl Arc-Welding">
                    <img src="<?php the_sub_field('image'); ?>">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="the-idea-cont brif-cont">
                    <?php the_sub_field('description'); ?>
                </div>
            </div>
        </div>
        <?php
            endif;
        endwhile;
        endif;
        ?>
    </div>
    </div>
</section>
<?php
    if( have_rows('layouts') ):
        while ( have_rows('layouts') ) : the_row();
            if( get_row_layout() == 'layout_1' ):
?>
<section class="duis_autem_section" style="background-image: url(<?php the_sub_field('image'); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="duis_autem">
                    <h3><?php the_sub_field('title'); ?> </h3>
                    <p><?php the_sub_field('description'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
            endif;
            if( get_row_layout() == 'layout_2' ):
?>
<section class="duis_section" style="background-image: url(<?php the_sub_field('image'); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6 col-md-12">
                <div class="duis_autem">
                    <h3><?php the_sub_field('title'); ?></h3>
                    <p><?php the_sub_field('description'); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="tig-div">
                    <?php
                        $options = get_sub_field('items');
                        if($options):
                            foreach($options as $option):
                    ?>
                    <div class="tig">
                        <?php echo $option['title']; ?>
                        <span><?php echo $option['text']; ?></span>
                    </div>
                   <?php
                            endforeach;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
        <?php
            endif;
            if( get_row_layout() == 'layout_3' ):
        ?>
<section class="ds_section" style="background-image: url(<?php the_sub_field('image'); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="duis_autem nobis_blc">
                    <span><?php the_sub_field('sub_title'); ?></span>
                    <h3><?php the_sub_field('title'); ?></h3>
                    <p><?php the_sub_field('description'); ?> </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
            endif;
        endwhile;
    endif;

    if(get_field('bottom_title')):
?>
<section class="progres nobis_section" style="background-image: url(<?php the_field('banner_image'); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(have_rows('options')):
                ?>
                <div class="owl-carousel owl-theme" id="owl-pro">
                    <?php
                        while(have_rows('options')): the_row()
                    ?>
                    <div class="item">
                        <div class="wit c100 p<?php the_sub_field('value'); ?>">
                            <span><?php the_sub_field('value'); ?>%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <h6><?php the_sub_field('option'); ?></h6>
                    </div>
                    <?php
                        endwhile;
                    ?>
                </div>
                <?php
                    endif;
                ?>
                <div class="nobis_div">
                    <h4><?php the_field('bottom_title')?></h4>
                    <p><?php the_field('bottom_description')?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    endif;

    endwhile;
    endif;
    get_footer();
?>

