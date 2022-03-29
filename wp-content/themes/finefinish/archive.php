<?php

/*

 * Archive Page

 * */

get_header();?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</div>
</section>
<?php

//$post_type = get_archive_post_type();

//

//if($post_type == 'industries'){

//    get_template_part('partials/content','projects');

//}

?>

<section class="awrd-hed">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="hed-bed" style="margin-top:0px">

                    <h1><?php echo post_type_archive_title(); ?></h1>

                    <div>

                        <a href="<?php echo home_url(); ?>">Home</a>     >    <?php echo post_type_archive_title(); ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="gray-cls">

    <div class="container">

<?php

    $i = 0;

    if (have_posts()) :

    while (have_posts()) : the_post();

            $i++;

        if($i % 2):

?>

        <div class="row ser-row">
            <div class="col-md-6">
                <div class="ser-lis">
                    <img src="<?php the_post_thumbnail_url(); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="ser-de">
                    <h4> <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h4>
                    <p><?php echo mb_strimwidth(get_the_content(), 0, 200, '..'); ?></p>
                    <a href="<?php the_permalink(); ?>">More</a>
                </div>
            </div>
        </div>
        <?php
            else:
        ?>
                <div class="row rit ser-row">
                    <div class="col-md-6 order-xl-1 order-lg-1 order-md-1 order-sm-2 order-2">
                        <div class="ser-de">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h4>
                            <p><?php echo mb_strimwidth(get_the_content(), 0, 200, '..'); ?></p>
                            <a href="<?php the_permalink(); ?>">More</a>
                        </div>
                    </div>
                    <div class="col-md-6 order-xl-2 order-lg-2 order-md-2 order-sm-1 order-1">
                        <div class="ser-lis">
                            <img src="<?php the_post_thumbnail_url(); ?>">
                        </div>
                    </div>
                </div>
<?php
    endif;
    endwhile;
        ?>


<div class="pegi">
        <?php echo paginate_links();

    ?>

</div>

<?php

    endif;

?>



    </div>

</section>

    <?php



get_footer();

?>