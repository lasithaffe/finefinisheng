<section class="footer-cont">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="questions">
                    <h4 style="color: #403a3a!important;">
                        Any Questions
                        <span>Contact us</span>
                    </h4>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6">
                        <div class="call-f">
                            <a href=""><img src="<?php echo ASSETS_IMAGE; ?>call.png"></a>
                            <span>call us</span>
                            <a href="tel:<?php the_field('phone_number', 'option'); ?>"><?php the_field('phone_number', 'option'); ?></a><br>
							<a href="tel:<?php the_field('phone_number_two', 'option'); ?>"><?php the_field('phone_number_two', 'option'); ?></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="call-f msg">
                            <a href=""><img src="<?php echo ASSETS_IMAGE; ?>msg.png"></a>
                            <span>Email Us</span>
                            <a href="mailto:<?php the_field('footer_email', 'option'); ?>"><?php the_field('footer_email', 'option'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="footer-left">
                    <h4>Come VIsit us</h4>
                    <div class="cont-fot-50">
                        <?php the_field('address1', 'option'); ?>
                    </div>
                    <div class="cont-fot-50">
                        <?php the_field('address2', 'option'); ?>
                    </div>
                    <div class="open-hr">
                        <?php the_field('working_hours', 'option'); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer-left ta-right">
                    <h4>Get the latest </h4>
					<ul class="sio-ul">
   <li><a class="fb" href="https://www.facebook.com/finefinisheng"></a></li>
   <li><a class="tw" href="https://twitter.com/finefinisheng"></a></li>
   <li><a class="in" href="https://www.linkedin.com/company/finefinish-engineering-pvt-ltd"></a></li>
   <li><a class="yt" href="https://www.youtube.com/channel/UCi1N9tV6qRG0FkIOe00YGig"></a></li>
</ul>
                  <!--   <ul class="sio-ul">
                        <?php
                            $social_links = get_field('social_links', 'option');
                            if($social_links):
                            foreach($social_links as $link):
                        ?>
                        <li><a class="<?php echo $link['class']; ?>" href=""></a></li>
                        <?php
                            endforeach;
                            endif;
                        ?>
                    </ul>-->
                    <div>
                        <p><?php the_field('copy_right', 'option'); ?></p>
<!--                         <p><a href="https://www.extremewebdesigners.com/services/web-design-sri-lanka/" target="_blank">Web Design</a> By <img src="<?php echo ASSETS_IMAGE; ?>e.png"><a href="https://www.extremewebdesigners.com/" target="_blank"> EWD</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="javascript:" id="return-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i>
</a>
<?php wp_footer(); ?>
<script type="text/javascript">
    jQuery(function(){
        jQuery("a.bla-1").YouTubePopUp();
    });
</script>

</body>
</html>


