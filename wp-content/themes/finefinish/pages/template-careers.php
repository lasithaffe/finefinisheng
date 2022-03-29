<?php
/*
 * Template Name: Careers
 * */

session_start();
if(!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

get_header();?>
<section class="header_strip" style="width:100%; margin-top: 71px;">
<div style="width:100%">
		<img src="https://www.finefinisheng.com/wp-content/uploads/2020/05/header-strip-01-01-scaled.jpg" width="100%">
</div>
</section>
<?php
while(have_posts()): the_post();

    $careers = array();

    $terms = get_terms([
        'taxonomy' => 'career_categories',
        'hide_empty' => false,
        'orderby' => 'id',
        'order' => 'ASC',
    ]);

    if($terms){

        $args = array(
            'post_type' => 'career',
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'career_categories',
                    'field'    => 'slug',
                    'terms'    => $terms[0]->slug
                )
            ),
        );

        $careers = new WP_Query($args);

    }

?>
    <section class="awrd-hed">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hed-bed">
                        <h1><?php the_title(); ?></h1>
                        <div>
                            <a href="<?php echo home_url(); ?>">Home</a>     >    <?php the_title(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lt-gry">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="awd-fr">
                        <?php the_content(); ?>
                     </div>
                </div>
                <div class="col-md-7">
                    <div class="careers-img">
                        <img class="img-responsive" src="<?php the_post_thumbnail_url(); ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="Sales">
                        <div class="opening">
                            <h4>Career Opennings In</h4>
                            <?php
                                if($terms):
                            ?>
                            <select name="position" id="departments" >
                                <?php foreach($terms as $term): ?>
                                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php
                                endif;
                            ?>
                        </div>
                        <div class="">
                            <ul class="car-main">
                                <?php
                                    while ( $careers->have_posts() ): $careers->the_post()
                                ?>
                                <li>
                                    <div>
                                        <span><?php the_modified_date('M d, Y')?></span>
                                        <h4><?php the_title(); ?></h4>
                                    </div>
                                    <div class="car-deil">
                                        <?php the_content(); ?>
                                        <a href="#<?php the_title(); ?>" data-name="<?php the_title(); ?>">Apply this Position</a>
                                    </div>
                                </li>
                                <?php
                                    endwhile;
                                    wp_reset_query();
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="car-frm">
                        <h4>Apply for job openings</h4>
                        <p>Please fill in your contact details and we'll contact you shortly</p>

                        <?php if(isset($message) && $message == 'success'){ ?>
                        <div class="success_message">
                            <h5>Success</h5>
                            <p>Your message successfully sent to administration.</p>
                        </div>
                        <?php
                            }elseif(isset($message) && $message == 'failed'){
                        ?>
                            <div class="error_message">
                                <h5>Failed</h5>
                                <p>Something went wrong, Please contact system administration.</p>
                            </div>
                        <?php
                                }
                            unset($_SESSION['message']);
                        ?>
                        <div class="frm-cr">
                            <form id="career_form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name*</label>
                                    <input type="text" name="full_name" data-validation="required">
                                </div>
                                <div class="col-md-6">
                                    <label>Contact Number*</label>
                                    <input type="text" name="contact_number" data-validation="number">
                                </div>
                                <div class="col-md-6">
                                    <label>Email Address*</label>
                                    <input type="email" name="email_address" data-validation="email">
                                </div>
                                <div class="col-md-12">
                                    <label>Applying Position*</label>
                                    <div class="selet-cr">
                                        <select id="job_position" name="job_position" data-validation="required">
                                            <option value="Any">Any</option>
                                            <?php
                                                while ( $careers->have_posts() ): $careers->the_post()
                                            ?>
                                            <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                            <?php
                                                endwhile;
                                                wp_reset_query();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label>Upload Resume*</label>
                                    <div class="file-cr">
                                        <span class="fil-text"></span>
                                        <input type="file" name="resume"
                                               accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf"
                                               data-validation="size"
                                               data-validation-allowing="doc, docx, pdf, txt"
                                               data-validation-max-size="5mb" required>
                                    </div>
                                    <span>FIle type should be docx,doc,pdf,txt</span>
                                </div>
                                <div class="col-md-12">
                                    <label>Additional Information</label>
                                    <textarea name="description"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="g-recaptcha" data-sitekey="6LfpJnwUAAAAAPiVAvYniz7q7gkXQ7SjYd7WMqja"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value="career_form">
                                    <input type="submit" value="Submit" class="submit" name="submit">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
endwhile;
get_footer();
?>
