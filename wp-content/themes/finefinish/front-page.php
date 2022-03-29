<?php
$landing_enable = get_field('landing_page', 'option');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	setcookie("fine_video", $landing_enable, time()+24*60*60);
	$landing_enable = 0;
}

if((isset($_COOKIE["fine_video"]) && $_COOKIE["fine_video"] == 1 || $landing_enable != 1)):

get_header();
$video_id = 0;
while(have_posts()): the_post();

$terms = get_terms([
	'taxonomy' => 'industry_category',
	'hide_empty' => false,
	'orderby' => 'id',
	'order' => 'DESC',
]);
?>

<div class="clear"></div>
<section class="header_strip" style="width:100%;  margin-top:71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
	</div>
</section>
<section class="video_header" >
	<div class="row">
		<div class="col-md-12">

			<div class="col-md-12" style="float:left; padding:0px">
				<video id="header_video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
					<?php
					if ( wp_is_mobile() ) {
					?>
					<source src="https://www.finefinisheng.com/wp-content/uploads/2020/04/My-Video.mp4" type="video/mp4">
					<?php } else {?>
					<source src="https://www.finefinisheng.com/wp-content/uploads/2020/05/My-Video1.webm" type="video/webm">
					<?php } ?>
				</video>
			</div>
<!-- 			<div class="col-md-3" style="float:left; padding:0px; padding-left:9px;">
				<div class="header_card">
					<img src="https://www.finefinisheng.com/wp-content/uploads/2020/04/header_card-01-1.jpg">
					<div class="header_card_descriptions">
						<h1>Check out our recent work!</h1>
						<p>
							The innovative nature of our solutions is founded on the culture of dynamic collaboration that we promote.
						</p>
						<button onclick="window.location.href = 'https://www.finefinisheng.com/solutions/';">
							<i class="fab fa-project-diagram"></i>
							Visit
						</button>
					</div>
				</div>
			</div> -->
		</div>
	</div>	
	
	<div class="overlay"></div>

</section>
<section id="facilities_mobile">
	<div id="accordion" class="py-5">
		<div class="card border-0">
			<div class="card-header p-0 border-0" id="heading-239">
				<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapse" data-toggle="collapse" data-target="#collapse-239" aria-expanded="true" aria-controls="#collapse-239"></button></a>
			</div>
			<div id="collapse-239" class="collapse show" aria-labelledby="heading-239" data-parent="#accordion">
				<div class="col-md-12">
					<a href="https://www.finefinisheng.com/facilities/"><img width="100%" src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-01.jpg"/></a>
				</div>
								<div class="col-md-12">
<!-- <div class="card-body accordion-body">
<p>Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
</div> -->
</div>

			</div>
		</div>
		<div class="card border-0 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
<!-- 			<div class="card-header p-0 border-0" id="heading-240">
								<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapsed" data-toggle="collapse" data-target="#collapse-240" aria-expanded="false" aria-controls="#collapse-240"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>Additive Manufacturing</button></a>
			</div> -->
			<div id="collapse-240" class="collapse " aria-labelledby="heading-240" data-parent="#accordion">
				<div class="col-md-12">
					<a href="https://www.finefinisheng.com/facilities/"><img width="100%" src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-02.jpg"/></a>
				</div>
<!-- 								<div class="card-body accordion-body">
<p>Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
</div> -->
			</div>
		</div>
		<div class="card border-0 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
<!-- 			<div class="card-header p-0 border-0" id="heading-241">
								<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapsed" data-toggle="collapse" data-target="#collapse-241" aria-expanded="false" aria-controls="#collapse-241"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>CNC Plasma / Laser Cut</button></a>
			</div> -->
			<div id="collapse-241" class="collapse " aria-labelledby="heading-241" data-parent="#accordion">
				<div class="col-md-12">
					<a href="https://www.finefinisheng.com/facilities/"><img width="100%" src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-03.jpg"/></a>
				</div>
<!-- 								<div class="card-body accordion-body">
<p>Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
</div> -->
			</div>
		</div>
		
		<div class="card border-0 wow fadeInUp card_last" style="visibility: visible; animation-name: fadeInUp;">
<!-- 			<div class="card-header p-0 border-0" id="heading-243">
								<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapsed" data-toggle="collapse" data-target="#collapse-243" aria-expanded="false" aria-controls="#collapse-243"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>Fabrication and Manual Machining</button></a>
			</div> -->
			<div id="collapse-243" class="collapse " aria-labelledby="heading-243" data-parent="#accordion">
				<div class="col-md-12">
					<a href="https://www.finefinisheng.com/facilities/"><img width="100%" src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-04.jpg"/></a>
				</div>
<!-- 								<div class="card-body accordion-body">
<p>Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
</div> -->
			</div>
		</div>
	</div>
</section>

<section id="facilities">
	<div class="row">
		<div class="col-md-12">
			<div class="facility_card"><img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-01.jpg"/>
				<div class="info">
					<h2>Precise CNC Machining</h2>
					<p class="facility_desc">Our CNC machining capabilities allow us to transform materials and produce custom
machined components for our partners with great precision and immense control.</p>
					<a href="https://www.finefinisheng.com/facilities/"><button>Read More</button></a>
				</div>
			</div>
			<div class="facility_card"><img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-02.jpg"/>
				<div class="info">
					<h2>Additive Manufacturing</h2>
					<p class="facility_desc">Our newly added 3D printing &amp; scanning solutions enables transformative approach to
industrial production that enables the creation of lighter, stronger parts and systems.</p>
					<a href="https://www.finefinisheng.com/facilities/"><button>Read More</button></a>
				</div>
			</div>
			<div class="facility_card"><img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-03.jpg"/>
				<div class="info">
					<h2>CNC Plasma / Laser Cut</h2>
					<p class="facility_desc">FFE’s plasma cutting machines are used to cut metals for a diverse range of purposes for
our partners</p>
					<a href="https://www.finefinisheng.com/facilities/"><button>Read More</button></a>
				</div>
			</div>
<!-- 			<div id="before_last_card" class="facility_card"><img src="https://www.finefinisheng.com/wp-content/uploads/2020/04/facilities-04.jpg"/>
				<div class="info">
					<h1>Wire Cut EDM</h1>
					<p class="facility_desc">Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
					<a href="https://www.finefinisheng.com/facilities/"><button>Read More</button></a>
				</div>
			</div> -->
			<div class="facility_card"><img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/facilities1-04.jpg"/>
				<div class="info">
					<h2>Fabrication and Manual Machining</h2>
					<p class="facility_desc">Our manual lathe &amp; milling machines fabricate your designs under the supervision of
skilled technicians</p>
					<a href="https://www.finefinisheng.com/facilities/"><button>Read More</button></a>
				</div>
			</div>
		</div>
	</div>
</section>

<h1 style="color:#fff">
	Manufacturing and industrial solutions Sri Lanka’s
</h1>
<section>
	        <div class="container-fluid">
	<div class="row" style="width:100%; padding-left: 3vw; padding-right: 3vw; padding-top: 20px;">

		<div class="welcom">
			<div id="industries_content" class="col-lg-8 col-md-12" style="float:left">
				<h2><?php the_field('sub_title')?></h2>
				<div>
					<?php the_content(); ?>
				</div>
				<a class="form_card" href="https://www.finefinisheng.com/project-intake/" target="_blank">
					<h3>Project Intake Form</h3>
					<p class="small">Please fill out the following form to enter a project request</p>
					<div class="go-corner" href="#" style="width: 10%; margin-top: 0px;">
						<div class="go-arrow" style="margin-top: 0px;color: white;">
							→
						</div>
					</div>
				</a>
			</div>
			<div id="form_section" class="col-lg-4 col-md-12" style=" float:left;margin-top: 87px;">
				<iframe width="100%" height="400" src="https://www.youtube.com/embed/dj6TmEfLggI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
<!-- 			<div id="form_section" class="col-lg-4 col-md-12" style=" float:left;margin-top: 87px;">
				<a class="form_card" href="#">
					<h3>Member Login</h3>
					<p class="small">Existing members can log into their dashboard</p>
					<div class="go-corner" href="#" style="width: 10%; margin-top: 0px;">
						<div class="go-arrow" style="margin-top: 0px;color: white;">
							→
						</div>
					</div>
				</a>
				
				<!-- 							<img src="https://www.finefinisheng.com/wp-content/uploads/2020/04/unnamed.gif"> -->
			</div> 
		</div>
	</div>
	        </div>
</section>
<section id="industries_list">
	<div id="accordion" class="py-5">
		<div class="card border-0">
			<div class="card-header p-0 border-0" id="heading-239">
				<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapse" data-toggle="collapse" data-target="#collapse-239" aria-expanded="true" aria-controls="#collapse-239"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>Apparel and Fashion </button></a>
			</div>
			<div id="collapse-239" class="collapse show" aria-labelledby="heading-239" data-parent="#accordion">
				<div class="card-body accordion-body">
					<p>FineFinish remains abreast of the machining requirements of the apparel industry through continuous research and development. We’ve addressed the industry’s distinct needs while working with companies like Victoria’s Secret.</p>
				</div>
			</div>
		</div>
		<div class="card border-0 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
			<div class="card-header p-0 border-0" id="heading-240">
				<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapsed" data-toggle="collapse" data-target="#collapse-240" aria-expanded="false" aria-controls="#collapse-240"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>Construction</button></a>
			</div>
			<div id="collapse-240" class="collapse " aria-labelledby="heading-240" data-parent="#accordion">
				<div class="card-body accordion-body">
					<p>In constructing structures for new projects, at times involving unprecedented design considerations, careful planning is essential. FFE offers construction-related services of a superior standard to enable on-time delivery of projects.</p>
				</div>
			</div>
		</div>
		<div class="card border-0 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
			<div class="card-header p-0 border-0" id="heading-241">
				<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapsed" data-toggle="collapse" data-target="#collapse-241" aria-expanded="false" aria-controls="#collapse-241"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>Consumable Product</button></a>
			</div>
			<div id="collapse-241" class="collapse " aria-labelledby="heading-241" data-parent="#accordion">
				<div class="card-body accordion-body">
					<p>FineFinish is highly skilled in manufacturing equipment required by consumable product companies. Our continued service of Coca-Cola, in producing their iconic beverage, stands as strong testament to this.</p>
				</div>
			</div>
		</div>
		<div class="card border-0 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
			<div class="card-header p-0 border-0" id="heading-242">
				<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapsed" data-toggle="collapse" data-target="#collapse-242" aria-expanded="false" aria-controls="#collapse-242"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>Ports and Aviation</button></a>
			</div>
			<div id="collapse-242" class="collapse " aria-labelledby="heading-242" data-parent="#accordion">
				<div class="card-body accordion-body">
					<p>As Ports and Aviation continues to build and expand, these industries consistently need the best parts to maintain efficient, reliable operations in a safe manner. As a leading Mechanical Service provider, FFE is able to provide services to meet their requirements on-time.</p>
				</div>
			</div>
		</div>
		<div class="card border-0 wow fadeInUp card_last" style="visibility: visible; animation-name: fadeInUp;">
			<div class="card-header p-0 border-0" id="heading-243">
				<a href="https://www.finefinisheng.com/facilities/"><button class="btn btn-link accordion-title border-0 collapsed" data-toggle="collapse" data-target="#collapse-243" aria-expanded="false" aria-controls="#collapse-243"><i class="fas fa-minus text-center d-flex align-items-center justify-content-center h-100"></i>Tire Industry</button></a>
			</div>
			<div id="collapse-243" class="collapse " aria-labelledby="heading-243" data-parent="#accordion">
				<div class="card-body accordion-body">
					<p>We formulate and see through new ideas for the tire industry, towards the end of fulfilling the needs of personal consumers. Our comprehensive offering includes 24-hour service and on-site assistance.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="flip_card_section" style="margin-top: 10px;margin-bottom: 39px;">
	<div class="row">
		<div id="flip_card_wrapper" class="col-md-12">
			<div class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="https://www.finefinisheng.com/wp-content/uploads/2021/04/flip_cards_new-02.jpg" alt="FineFinish remains abreast of the machining requirements of the apparel industry" style="width:100%;">
					</div>
					<div class="flip-card-back">
						<h2>Apparel and Fashion</h2>
						<p>FineFinish remains abreast of the machining requirements of the apparel industry through continuous research and development. We’ve addressed the industry’s distinct needs while working with companies like Victoria’s Secret.</p>
						<a class="btn_visit" href="https://www.finefinisheng.com/industries/apparel-fashion/">
							<div class="card_button">
								<span>Visit</span>
								<svg>
									<polyline class="o1" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
									<polyline class="o2" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
								</svg>
							</div>
						</a>


					</div>
				</div>
			</div>
			<div class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="https://www.finefinisheng.com/wp-content/uploads/2021/04/flip_cards_new-03.jpg" alt="FFE offers construction-related services" style="width:100%;">
					</div>
					<div class="flip-card-back">
						<h3>Construction</h3>
						<p>In constructing structures for new projects, at times involving unprecedented design considerations, careful planning is essential. FFE offers construction-related services of a superior standard to enable on-time delivery of projects.</p>
						<a class="btn_visit" href="https://www.finefinisheng.com/industries/construction/">
							<div class="card_button">
								<span>Visit</span>
								<svg>
									<polyline class="o1" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
									<polyline class="o2" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
								</svg>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="https://www.finefinisheng.com/wp-content/uploads/2021/04/flip_cards_new-04.jpg" alt="manufacturing equipment required by consumable product companies" style="width:100%;">
					</div>
					<div class="flip-card-back">
						<h3>Consumable Product</h3>
						<p>FineFinish is highly skilled in manufacturing equipment required by consumable product companies. Our continued service of Coca-Cola, in producing their iconic beverage, stands as strong testament to this.</p>
						<a class="btn_visit" href="https://www.finefinisheng.com/industries/consumable-product/">
							<div class="card_button">
								<span>Visit</span>
								<svg>
									<polyline class="o1" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
									<polyline class="o2" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
								</svg>
							</div>

						</a>
					</div>
				</div>
			</div>
			<div id="before_last_flip_card" class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="https://www.finefinisheng.com/wp-content/uploads/2021/04/flip_cards_new-05.jpg" alt="leading Mechanical Service provider Ports and Aviation continues" style="width:100%;">
					</div>
					<div class="flip-card-back">
						<h3>Ports and Aviation</h3>
						<p>As Ports and Aviation continues to build and expand, these industries consistently need the best parts to maintain efficient, reliable operations in a safe manner. As a leading Mechanical Service provider, FFE is able to provide services to meet their requirements on-time.</p>
						<a class="btn_visit" href="https://www.finefinisheng.com/industries/ports-and-aviation/">
							<div class="card_button">
								<span>Visit</span>
								<svg>
									<polyline class="o1" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
									<polyline class="o2" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
								</svg>
							</div>

						</a>
					</div>
				</div>
			</div>
			<div class="flip-card">
				<div class="flip-card-inner">
					<div class="flip-card-front">
						<img src="https://www.finefinisheng.com/wp-content/uploads/2021/04/flip_cards_new-06.jpg" alt="tire industry service" style="width:100%;">
					</div>
					<div class="flip-card-back">
						<h2>Tire Industry</h2>
						<p>We formulate and see through new ideas for the tire industry, towards the end of fulfilling the needs of personal consumers. Our comprehensive offering includes 24-hour service and on-site assistance.</p>
						<a class="btn_visit" href="https://www.finefinisheng.com/industries/tire/">
							<div class="card_button">
								<span>Visit</span>
								<svg>
									<polyline class="o1" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
									<polyline class="o2" points="0 0, 150 0, 150 55, 0 55, 0 0"></polyline>
								</svg>
							</div>

						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--     <div id="val">0</div> -->

<div class="anim">
	<div class="ani-top">
		<?php
		if(have_rows('section')):
		$last_row = count(get_field('section'));
		$a=0;
		while(have_rows('section')): the_row();
		$id = get_row_index();
		if($id % 2):
		?>
		<section class="back-d scl <?php if($a++ == '0'){echo 'fest-sec'; } ?>">
			<!--         <div class="cat-right">
<div><span>Our Clients</span> / <?php the_sub_field('right_text'); ?> </div>
</div> -->
			<div class="container">
				<div class="row">
					<div class="col-lg-6 order-lg-1 order-md-2 order-sm-2 order-2" data-aos="fade-right" data-aos-anchor-placement="center-bottom">
						<div class="our-clnt" >
							<h4><?php the_sub_field('title'); ?> </h4>
							<p><?php the_sub_field('description'); ?></p>
							<a href="<?php the_sub_field('page_link'); ?>">Read More</a>
						</div>
					</div>
					<div class="col-lg-6 order-lg-2 order-md-1 order-sm-1 order-1" data-aos="zoom-in-down" data-aos-anchor-placement="center-bottom">
						<div class="clnt-img">
							<div class="owl-carousel owl-theme hom-sld">

								<?php $slid_gals = get_sub_field('gallery');
								foreach($slid_gals as $slid_gal): ?>
								<div class="item"><img src="<?php echo $slid_gal['url']; ?>"></div>
								<?php endforeach; ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php else: 
			if($a!==($last_row / 2)):
		?>
		<section class="back-d scl">
			<!--         <div class="cat-right">
<div><span>Our Clients</span> / <?php the_sub_field('right_text'); ?> </div>
</div> -->
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="clnt-img" data-aos="zoom-in-down" data-aos-anchor-placement="center-bottom">
							<div class="owl-carousel owl-theme hom-sld">

								<?php $slid_gals = get_sub_field('gallery');
								foreach($slid_gals as $slid_gal): ?>
								<div class="item"><img src="<?php echo $slid_gal['url']; ?>"></div>
								<?php endforeach; ?>

							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="our-clnt right" data-aos="fade-right" data-aos-anchor-placement="center-bottom">
							<h4 ><?php the_sub_field('title'); ?></h4>
							<p><?php the_sub_field('description'); ?></p>
							<a href="<?php the_sub_field('page link'); ?>">Read More</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		else:
		?>
		<section class="r_and_d back-d scl">
			<!--         <div class="cat-right">
<div><span>Our Clients</span> / <?php the_sub_field('right_text'); ?> </div>
</div> -->
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="clnt-img" data-aos="zoom-in-down" data-aos-anchor-placement="center-bottom">
							<div class="owl-carousel owl-theme hom-sld">

								<?php $slid_gals = get_sub_field('gallery');
								foreach($slid_gals as $slid_gal): ?>
								<div class="item"><img src="<?php echo $slid_gal['url']; ?>"></div>
								<?php endforeach; ?>

							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="our-clnt right" data-aos="fade-right" data-aos-anchor-placement="center-bottom">
							<h4 ><?php the_sub_field('title'); ?></h4>
							<h4 >Research And Development</h4>
							<p><?php the_sub_field('description'); ?></p>
							<a href="https://www.finefinisheng.com/innovation-comes-from-collaboration/">Visit R&D Department</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		endif;
		endif;
		endwhile;
		endif;
		?>
	</div>
</div>
<div class="gapdiv"></div>
<section class="why-back">
	<!--         <div class="cat-right gry-lef">
<div><span>Why Choose us</span> </div>
</div> -->
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="wy-choos">
					<h2><?php the_field('why_title'); ?></h2>
					<a href="<?php the_field('why_link'); ?>">Learn More </a>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="wy-choos">
					<p><?php the_field('why_description'); ?></p>
				</div>
			</div>
			<div class="col-lg-4" style="background-image: url(https://www.finefinisheng.com/wp-content/uploads/2018/11/Safety-work-tool.png);">

			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="work">
					<p>We also work with :</p>
					<div class="owl-logomob">
						<?php
						$images = get_field('why_logos');
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
						$logos = get_field('why_logos');
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
	</div>
</section>

<?php
endwhile;
get_footer();

else:
?>
<style type="text/css">
	.inrto-vid{
		width: 100%;
		margin: 0 auto;
		display: block;
		position: relative;
		z-index: 10
	}
	.inrto-vid:after{
		position: absolute;
		width: 100%;
		height: 100%;
		content: '';
		background-color: #000;
	}
	.vid-btn button{
		width: 196px;
		border: none;
		color: #fff;
		font-size: 18px;
		text-transform: uppercase;
		margin: 15px auto 0px;
		padding: 10px;
		display: block;
		position: absolute;
		bottom: 0px;
		left: 0px;
		right: 0px;
		margin: 0 auto;
		z-index: 10;
		background-color: rgba(0,0,0,0);
		cursor: pointer;
	}
	.ful-wth{
		height: 100%;
		overflow: hidden;
	}
	body{
		background-color: #000;
		margin: 0px;
	}
</style>
<div class="ful-wth">
	<video class="video-ply inrto-vid" id="vid"  loop="loop" autoplay="autoplay">
		<source src="<?php the_field('landing_video', 'option'); ?>" type="video/mp4">
		<source src="mov_bbb.ogg" type="video/ogg">
		Your browser does not support HTML5 video.
	</video>
	<div class="vid-btn">
		<form action="" method="POST">
			<button type="submit" name="submit">Skip intro video</button>
		</form>
	</div>
</div>
<script>
	document.getElementById('vid').play();
</script>
<?php endif; ?>
<script>
AOS.init();
</script>