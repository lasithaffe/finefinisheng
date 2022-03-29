<?php

/*

 * Template Name: Solutions

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

<!--         <section class="awrd-hed">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <div class="hed-bed">

                            <h1><?php the_title(); ?></h1>

                            <div>

                                <a href="<?php the_permalink(); ?>">Home</a>    >    <?php the_title(); ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section> -->



        <section class="se1-section">



            <div class="container">

                <div class="row">

                    <div class="col-md-7">

                        <div class="so-se1">

                            <h4><?php echo get_field('v_title'); ?></h4>

                            <p><?php echo get_field('v_description'); ?></p>

                        </div>

                    </div>

                    <div class="col-md-5">

                        <div class="ply-co">

                            <a class="bla-1" href="<?php echo get_field('video_url'); ?>"><img src="<?php echo ASSETS_IMAGE; ?>watch-video.png"></a>

                        </div>

                    </div>

                </div>

            </div>

            <video video autoplay muted loop id="myVideo">

                <source src="<?php echo get_field('video'); ?>" type="video/mp4">

                <source src="<?php echo ASSETS_IMAGE; ?>" type="video/ogg">

                Your browser does not support the video tag.

            </video>

            <img class="f1-l" src="<?php echo ASSETS_IMAGE; ?>f1-l.png">

            <img class="f1-r" src="<?php echo ASSETS_IMAGE; ?>f1-r.png">

        </section>

        <section class="se2-section" style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution1-1.jpg');border-bottom: solid #000 0.5px;
}

">

            <div class="container">

                <div class="row">

                    <div class="col-md-9">

                        <div class="so-se1">

                            <h4><?php the_field('c_title'); ?></h4>

                            <?php the_field('c_description'); ?>

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="deit-enqur">
                            <p>Interested ? Inquire now</p>
                            <a href="<?php echo get_home_url(); ?>/contact-us/">Inquire now</a>
                        </div>
                    </div>

                </div>

            </div>

<!--             <img class="f1-l" src="<?php echo ASSETS_IMAGE; ?>f2-l.png">

            <img class="f1-r" src="<?php echo ASSETS_IMAGE; ?>f2-r.png"> -->

        </section>
        
<section class="com-sec se10-section" style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution2-4.jpg');border-bottom: solid #000 0.5px;
}

">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                <div class="se-cont left-sec"  data-aos-duration="2000" data-aos="fade-right">
                    <h4><?php the_field('os_title'); ?></h4>

                            <?php the_field('os_description'); ?>
                </div>
            </div>
            <div class="col-lg-6 order-xl-2 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="automation_ani"> 
                    <img class="auto-1" src="<?php echo ASSETS_IMAGE; ?>ani/auto-1.png">
                    <img class="auto-2" src="<?php echo ASSETS_IMAGE; ?>ani/auto-2.png">
                    <img class="auto-3" src="<?php echo ASSETS_IMAGE; ?>ani/auto-3.png">
                    <img class="auto-4" src="<?php echo ASSETS_IMAGE; ?>ani/auto-4.png">
                    <img class="auto-5" src="<?php echo ASSETS_IMAGE; ?>ani/auto-5.png">
                    <img class="auto-6" src="<?php echo ASSETS_IMAGE; ?>ani/auto-6.png">
                    <img class="auto-7" src="<?php echo ASSETS_IMAGE; ?>ani/auto-7.png">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="com-sec se11-section" style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution3-3.jpg');border-bottom: solid #000 0.5px;
}

">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="gear_wheel">
                    <img class="weel-1" src="<?php echo ASSETS_IMAGE; ?>ani/weel-1.png">
                    <img class="weel-2" src="<?php echo ASSETS_IMAGE; ?>ani/weel-2.png">
                    <img class="weel-3" src="<?php echo ASSETS_IMAGE; ?>ani/weel-2.png">
                    <img class="weel-4" src="<?php echo ASSETS_IMAGE; ?>ani/weel-3.png">
                    <img class="weel-5" src="<?php echo ASSETS_IMAGE; ?>ani/weel-3.png">
                    <img class="weel-6" src="<?php echo ASSETS_IMAGE; ?>ani/weel-4.png">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="se-cont left-sec"  data-aos-duration="2000" data-aos="fade-left">
                    <h4><?php the_field('osj_title'); ?></h4>

                            <?php the_field('osj_description'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="com-sec se5-section" style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution4-4.jpg');border-bottom: solid #000 0.5px;
}

">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                <div class="se-cont left-sec" data-aos-duration="2000" data-aos="fade-right">
                    <h4><?php the_field('osad_title'); ?></h4>

                            <?php the_field('osad_description'); ?>
                </div>
            </div>
            <div class="col-lg-6 col-12 order-xl-2 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="car" > 
                    <img src="<?php echo ASSETS_IMAGE; ?>car.png">
                    <img class="str st1" src="<?php echo ASSETS_IMAGE; ?>str.png">
                    <img class="str st2" src="<?php echo ASSETS_IMAGE; ?>str.png">
                    <img class="str st3" src="<?php echo ASSETS_IMAGE; ?>str.png">
                    <img class="str st4" src="<?php echo ASSETS_IMAGE; ?>str.png">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="com-sec se12-section" style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution5-3.jpg');border-bottom: solid #000 0.5px;
}

">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="mold_making">
                    <img class="mold-1" src="<?php echo ASSETS_IMAGE; ?>ani/mold-1.png">
                    <img class="mold-2" src="<?php echo ASSETS_IMAGE; ?>ani/mold-2.png">
                    <img class="mold-3" src="<?php echo ASSETS_IMAGE; ?>ani/mold-3.png">
                    <img class="mold-4" src="<?php echo ASSETS_IMAGE; ?>ani/mold-4.png">
                    <img class="mold-5" src="<?php echo ASSETS_IMAGE; ?>ani/mold-5.png">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="se-cont left-sec" data-aos-duration="2000" data-aos="fade-left">
                    <h4><?php the_field('osh_title'); ?></h4>

                            <?php the_field('osh_description'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="com-sec se17-section"  style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution6-3.jpg');border-bottom: solid #000 0.5px;
}

">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                <div class="se-cont left-sec" data-aos-duration="2000" data-aos="fade-right">
                    <h4><?php the_field('ose_title'); ?></h4>

                            <?php the_field('ose_description'); ?>
                </div>
            </div>
            <div class="col-lg-6 col-12 order-xl-2 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="metal-ani" > 
                    <img class="val-1" src="<?php echo ASSETS_IMAGE; ?>ani/val-1.png">
                    <img class="val-2" src="<?php echo ASSETS_IMAGE; ?>ani/val-2.png">
                    <img class="val-3" src="<?php echo ASSETS_IMAGE; ?>ani/val-3.png">
                    <img class="val-4" src="<?php echo ASSETS_IMAGE; ?>ani/val-4.png">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="com-sec se14-section" style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution6-3.jpg');border-bottom: solid #000 0.5px;
}

">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hydraulic_making">
                    <img class="hydr-1" src="<?php echo ASSETS_IMAGE; ?>ani/hd-car.png">
                    <img class="hydr-2" src="<?php echo ASSETS_IMAGE; ?>ani/hd-jak.png">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="se-cont left-sec" data-aos-duration="2000" data-aos="fade-left">
                    
                            <h4><?php the_field('osm_title'); ?></h4>

                            <?php the_field('osm_description'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="com-sec se15-section" style="background-image: url('https://www.finefinisheng.com/wp-content/uploads/2020/04/solution8.jpg');border-bottom: solid #000 0.5px;
}

">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                <div class="se-cont left-sec" data-aos-duration="2000" data-aos="fade-right">
                    <h4><?php the_field('osf_title'); ?></h4>

                            <?php the_field('osf_description'); ?>
                </div>
            </div>
            <div class="col-lg-6 col-12 order-xl-2 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="research_ani" > 
                    <img class="res-2" src="<?php echo ASSETS_IMAGE; ?>ani/res-2.png">
                    <img class="res-1" src="<?php echo ASSETS_IMAGE; ?>ani/res-1.png">
                </div>
            </div>
        </div>
    </div>
</section>


<?php

    endwhile;

get_footer();

?>

