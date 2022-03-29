<?php
    $post_id = get_id_by_slug('our-projects');
?>

<section class="sec-cnc" style="background-image: url(<?php echo get_the_post_thumbnail_url($post_id)?>)">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="hed-cnc">
                <span><?php the_field('sub_title', $post_id); ?></span>
                <h3><?php the_field('title', $post_id); ?></h3>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="cnc-cont">
                <p><?php echo get_post_field('post_content', $post_id); ?></p>
                <a href="">Read More</a>
            </div>
        </div>
    </div>
</section>

<section class="os-sec">
    Other Services
</section>