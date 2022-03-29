<?php
/*
 * Project Single Page
 * */
get_header();
while(have_posts()): the_post();

    $banner_header = get_field('project_header');
    $body_section  = get_field('body_section');

?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</div>
</section>
<section class="about-banner" style="background-image: url(<?php echo $banner_header['banner']; ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="prdit-top">
                    <h2><?php the_title(); ?></h2>
                    <div class="pr-clnt">
                        <div>
                            <div>
                                <span>Client</span>
                                <p><?php echo get_the_title($banner_header['client']); ?></p>
                            </div>
                            <img src="<?php the_field('logo',$banner_header['client'] )?>">
                        </div>
                        <div>
                            <div>
                                <span>PROJECT TYPE</span>
                                <p><?php echo $banner_header['project_type']->name; ?></p>
                            </div>
                        </div>
                        <div>
                            <div>
                                <span>STATUS</span>
                                <p>Completed on 2017</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="the-idea">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="the-idea-cont">
                    <h2><?php echo $body_section['content_title']; ?></h2>
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="main-pl">
                    <div class="pr-plan">
                        <div>
                            <span>Propossed Plan</span>
                        </div>
                    </div>
                    <div class="clik-img">
                        <?php
                            if($body_section['plan_popup']):
                                foreach($body_section['plan_popup'] as $popup):
                        ?>
						<span class="pin" style="left: <?php echo $popup['position_left']; ?>px;top: <?php echo $popup['position_top']; ?>px;">
							<img src="<?php echo ASSETS_IMAGE; ?>+.png">
							<div>
                                <h5><?php echo $popup['title']; ?></h5>
                                <p><?php echo $popup['description']; ?></p>
                            </div>
						</span>
						<?php
                                endforeach;
                            endif;
                        ?>
                        <img src="<?php echo $body_section['plan_image']; ?>">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="side-cont">
        <span>The Idea</span>
    </div>
</section>

<?php
    $progress = $body_section['progress_block'];
    if($progress):
?>

<section class="progres">
    <div class="container">
        <div class="progres-hed">
            <h4>Progress Summary</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="process-div">
                    <div class="pro-lin">
                        <p>Overall Process</p><span><?php echo $progress['overall']; ?>%</span>
                    </div>
                    <div class="w3-border">
                        <div class="w3-grey" style="width:<?php echo $progress['overall']; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme" id="owl-pro">
                    <?php
                        foreach($progress['summary'] as $block):
                    ?>
                    <div class="item">
                        <div class="c100 p<?php echo $block['progress']; ?>">
                            <span><?php echo $block['progress']; ?>%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <h6><?php echo $block['title']; ?></h6>
                        <p><?php echo $block['description']; ?></p>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="side-cont">
        <span>Progress</span>
    </div>
</section>
<?php
    endif;

    if(have_rows('problems')):
?>

<section class="ps-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 min-50">
                <div class="problems-left">
                    <div class="problems-div">
                        <h4>
                            Our quality, safety and on-site 
                            <span>service assurance</span>
                        </h4>
                    </div>
                    <div class="bar-act">
                    <?php
                    while(have_rows('problems')): the_row();
                        ?>
                        <div id="bar-<?php echo get_row_index(); ?>"  class="<?php echo get_row_index() == 1? 'actv' : ''; ?>"></div>
                        <?php
                    endwhile;
                    ?>
                    </div>
                </div>
                <div class="bar-cont">
                    <?php
                        while(have_rows('problems')): the_row();
                    ?>
                    <div class="bar-<?php echo get_row_index(); ?> <?php echo get_row_index() == 1? 'actv' : ''; ?>">
                        <?php the_sub_field('solutions'); ?>
                    </div>
                    <?php
                        endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="side-cont">
        <span> Solution</span>
    </div>
</section>
<?php
    endif;
?>
<section class="reviews-section" style="background-image: url(<?php echo ASSETS_IMAGE.'reviews.png'; ?>); ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="client-h4">
                    <h4>
                        <span>Client</span>
                        Reviews
                    </h4>
                    <h5><?php the_field('r_title'); ?> </h5>
                    <p><?php the_field('r_description'); ?></p>
                    <p><span class="w500"><?php the_field('name'); ?></span>
                        <span><?php the_field('company'); ?> </span></p>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php
    if(have_rows('projects')):
        ?>
<section class="sec-relatd">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="related-div">
                    <div class="problems-div">
                        <h4>
                            Related
                            <span>Projects</span>
                        </h4>
                        <p><?php the_field('project_text'); ?> </p>
                    </div>
                </div>
                <div class="related-owl">
                    <div class="owl-carousel owl-theme" id="owl-proj">
                        <?php
                           while(have_rows('projects')): the_row()
                        ?>
                        <div class="item">
                            <?php if(get_sub_field('link')): ?>
                            <a href="<?php echo get_sub_field('link') ? get_sub_field('link') : '#'; ?>">
                            <?php endif; ?>
                                <div class="pro">
                                    <img src="<?php echo get_sub_field('image')?>">
                                    <h5><?php echo get_sub_field('title'); ?></h5>
                                    <p><?php echo mb_strimwidth(get_sub_field('description'), 0, 200, '...'); ?> </p>
                                    <span></span>
                                </div>
                               <?php if(get_sub_field('link')): ?>
                            </a>
                                <?php endif; ?>
                        </div>
                       <?php
                            endwhile;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    endif;
endwhile;
get_footer();
?>