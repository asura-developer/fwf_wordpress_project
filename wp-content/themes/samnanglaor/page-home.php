<?php 
get_header(); 
?>
<div class="slideshow">
    <?php 
    if(qtranxf_getLanguage() == 'kh')
        { echo do_shortcode('[rev_slider alias="slider-1-1"][/rev_slider]');}
    else
        {echo do_shortcode('[rev_slider alias="slider-1"][/rev_slider]'); }
    ?>
</div>

<section id="aboutus">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="section-title"><?php the_field('aboutus_title'); ?></div>
                <div class="linegray"></div>
                <div class="section-desc">
                    <?php the_field('about_us_short_description');?>
                </div>

                <div class="more">
                    <a href="#">
                        <?php __nt('read more'); ?> <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-image">
                    <img src="<?php the_field('photo_about_section'); ?>" > 
                </div>
            </div>
        
        </div>

    </div>


</section>



<section id="latest-project">
    <div class="list-wrap">
    <div class="container">
        <div class="center-center">
            <div class="section-title-center"><?php the_field('latest_project_title'); ?></div>
            <div class="linegray"></div>
            <div class="desc">
                <?php the_field('latest_project_short_description'); ?>
            </div>
        </div>
        <div class="row">       
            <?php
                // WP_Query arguments
                $args = array(
                    'post_type'              => array( 'project' ),
                    'posts_per_page'         => '3',
                );

                // The Query
                $query = new WP_Query( $args );

                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                    ?>
                    <div class="col-md-4">
                        <a href="<?php the_permalink(); ?>">
                            <div class="project-item">
                                <div class="btnviewmore">
                                   <div class="btn-outline"> <?php __nt('Read more'); ?></div>
                                </div>
                                <img src="<?php the_post_thumbnail_url( ); ?>">
                                <div class="projecttitle"><?php the_title(); ?></div>
                            </div>
                        </a>
                    </div>   
                    <?php
                    }
                } else {
                    // no posts found
                }

                // Restore original Post Data
                wp_reset_postdata();
            ?>

           </div>

           <div class="center-center more ph20">
                <a href="<?php echo get_home_url(); ?>/portfolio">
                    <?php __nt('MORE PORFOLIO'); ?> <i class="fas fa-chevron-right"></i>
                </a>
            </div>
       </div>
    </div>

</section>


<section id="testimonail" >
  <div class="section-background" style="background-image: url('<?php echo get_home_url(); ?>/wp-content/uploads/2020/10/Concrete-Texture-2.jpg');">

  </div>
    <div class="container">
            <div class="center-center">
                <div class="section-title-center" style="color: white;"><?php the_field('testimonails_title'); ?></div>
                <div class="linegray" style="background: white;"></div>
                <div class="container wrap">
                    <div class="owl-carousel">
                    <?php
                        // WP_Query arguments
                        $args = array(
                            'post_type'              => array( 'testimonial' ),
                            'posts_per_page'         => '3',
                        );

                        // The Query
                        $query = new WP_Query( $args );

                        // The Loop
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                            ?>
                                <div class="testi-item">
                                    <div class="testi-desc">
                                        <?php the_content(); ?>
                                    </div>
                                    <div class="testi-title">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            // no posts found
                        }

                        // Restore original Post Data
                        wp_reset_postdata();
                    ?>

                    </div>
                </div>
            </div>
    </div>    
    
    <script>
        j(document).ready(function(){
            j(".owl-carousel").owlCarousel({
                loop:true,
                nav:true,
                dots:true,
                items: 1,
            });
        });
    </script>    

</section>

<section id="latest-news">
    <div class="container">
                <div class="center-center">
                    <div class="section-title-center"><?php the_field('latest_news'); ?></div>
                    <div class="linegray"></div>
                    <div class="container wrap latestnews">
                     <div class="row">
                        <?php
                            // WP_Query arguments
                            $args = array(
                                'post_type'              => array( 'post' ),
                                'posts_per_page'         => '7',
                            );

                            // The Query
                            $query = new WP_Query( $args );

                            // The Loop
                            $j = 0;
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                ?>
                                <?php if($j == 0) { ?>
                                    <div class="col-md-6">
                                        <a href="<?php the_permalink() ?>">
                                            
                                            <div class="news-items" style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
                                                <div class="btnviewmore">
                                                        <div class="btn-outline"> <?php __nt('Read more'); ?></div>
                                                </div>    
                                            
                                            <div class="desc-overlay">
                                                    <div class="newsdate"><?php __nt('DATE:'); ?> <?php the_date(); ?></div>
                                                    <div class="newstitle"><?php the_title(); ?></div>
                                                    <div class="postread">
                                                        <i class="fas fa-bars"></i> <?php __nt('READ'); ?>
                                                    </div>
                                                </div>
                                            </div>   
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-3">
                                        <a href="<?php the_permalink()?>">
                                           <div class="smallnewitem">
                                                <div class="newsimgbox">
                                                    <div class="btnviewmore">
                                                            <div class="btn-outline"> <?php __nt('Read more'); ?></div>
                                                    </div>
                                                    <img src="<?php the_post_thumbnail_url( ); ?>">
                                                </div>
                                                <div class="smalldescbox">
                                                    <div class="smallpostdate"><?php __nt('DATE:'); ?> <?php echo get_the_date(); ?></div>
                                                    <div class="smalltitle"><?php the_title(); ?></div>
                                                    <div class="smallpostread">
                                                                <i class="fas fa-bars"></i> <?php __nt('READ'); ?>
                                                    </div>
                                                </div>
                                            </div>    
                                        </a>    
                                    </div>

                                <?php } ?>
                                    
                                <?php
                                $j+=1;
                              }
                            } else {
                                // no posts found
                            }

                            // Restore original Post Data
                            wp_reset_postdata();
                        ?>
                       </div>
                     </div>
                </div>
    </div>                
</section>



<?php get_footer(); ?>