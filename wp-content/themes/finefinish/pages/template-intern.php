<?php
/*
 * Template Name: Intern
 * */
get_header();?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</div>
</section>
<?php
while(have_posts()): the_post();

    $counts = get_field('count_blocks');
    $vision_mission = get_field('vision_mission');
?>
<section class="about-banner" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="abu-left">
                    <h1><?php the_title(); ?></h1>
                    <h2><?php the_field('sub_title'); ?></h2>
                </div>
            </div>
            <div class="col-md-6">
                <?php if($counts): ?>
                <div class="rig-clint">
                    <div>
                        <span><?php echo $counts['count']; ?>+</span>
                        <p><?php echo $counts['count_title']; ?></p>
                    </div>
                    <div>
                        <span><?php echo $counts['count_3']; ?>+</span>
                        <p><?php echo $counts['count_title_3']; ?></p>
                    </div>
                    <div>
                        <span><?php echo $counts['count_2']; ?>+</span>
                        <p><?php echo $counts['count_title_2']; ?></p>
                    </div>
                </div>
                <?php endif; ?> 
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
                    <img src="<?php the_field('right_image'); ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="vis-mis">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="micvis lef">
                    <h4><?php echo $vision_mission['v_title']; ?></h4>
                    <p><?php echo $vision_mission['vi_description']; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="micvis rit">
                    <h4><?php echo $vision_mission['m_title']; ?></h4>
                    <p><?php echo $vision_mission['m_description']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="oc-mang">
                    <h4>Team</h4>
                    <p>The Brains Behind Creative Solutions </p>
                </div>
<!--                 <div class="row">
                
                <div class="owl-carousel owl-theme" id="owl-mang">
                    
                <?php 
                if( have_rows('team') ):
                    $a=0;
                while ( have_rows('team') ) : the_row(); ?>
                    <div class="item">
                        <div class="mang-div">
                            <div>
                                <img src="<?php the_sub_field('image_man');?>">
                               
                            </div>
                            <h4><?php the_sub_field('name_man');?></h4>
                            <p><?php the_sub_field('position_man');?></p>
                            <span style="padding: 0px 10px;"><?php the_sub_field('other_man');?></span>
                        </div>
                        
                    </div>

                <?php endwhile;
                        endif;
                ?>
                </div>
                
                </div> -->
				
				
				<div class="row">
                
                    
                <?php 
                if( have_rows('team') ):
                    $a=0;
                while ( have_rows('team') ) : the_row(); ?>
					<div class="col-md-4" style="margin-bottom:50px;">
						<div class="item">
                        <div class="mang-div">
                            <div>
                                <img src="<?php the_sub_field('image_man');?>">
                               
                            </div>
                            <h4><?php the_sub_field('name_man');?></h4>
                            <p><?php the_sub_field('position_man');?></p>
                            <span style="padding: 0px 10px;"><?php the_sub_field('other_man');?></span>
                        </div>
                        
                    </div>
					</div>
               <?php endwhile;
                        endif;
                ?>
                
                </div>
				
				
				
				
            </div>
		 <div class='mem-cont'>
			 <h4>VISIONARY</h4>
			 <div class="oc-mang">
				 <?php the_field('mem-cont'); ?>
			 </div>
			</div>
        </div>
		
		
    </div>
</section>
<section class="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="oc-abut ">
                    <h4>Our Clients</h4>
                </div>
           


            <div class="owl-logomob">
                <?php
                    $images = get_field('logos');
                    if($images):
                ?>
                <div class="owl-carousel owl-theme" id="owl-logo">
                    <?php foreach($images as $image): ?>
                    <div class="item"><img src="<?php echo $image['url']; ?>"></div>
                    <?php endforeach; ?>
                </div>
                <?php
                    endif;
                ?>
            </div>
            <div class="owl-logodex">
                <?php
                    $logos = get_field('logos');
                    $images = array_chunk($logos, 6);
                    if($images):
                ?>
                <div class="owl-carousel owl-theme" id="owl-logodex">
                    <?php foreach($images as $imgs): ?>
                    <div class="item">
                            <?php 
                                foreach ($imgs as $image) :
                            ?>
                        <img src="<?php echo $image['url']; ?>">

                            <?php endforeach; ?>
                    </div>
            
                    <?php endforeach; ?>
                </div>
                <?php
                    endif;
                ?>
            </div>


            </div>
        </div>
    </div>
</section>
    <?php
endwhile;
get_footer();
?>