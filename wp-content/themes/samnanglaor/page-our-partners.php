<?php get_header(); ?>

<div class="wrapper">
    <div class="hero" style="background-image: url(<?php the_post_thumbnail_url()?>); background-position: center;">
        <div class="tranbar">   
            <div class="container">
                    <div class="hero-title">
                        
                        <div class="bblack"><?php the_title(); ?></div>
                        <div class="bblack"><?php __nt('NATIONAL CONCRETE'); ?></div>

                    </div>
                    <!-- End hero title -->
            </div>
            <!-- End container -->
        </div>    
        <!-- end tran bar -->
    </div>
    <!-- End hero section -->



    <div class="listingsection">

        <div class="container grid-container">
            <div class="row">
                
            <?php
                            // WP_Query arguments
                            $args = array(
                                'post_type'              => array( 'partners' ),
                                'posts_per_page'         => '-1',
                            );

                            // The Query
                            $query = new WP_Query( $args );

                            // The Loop
                        
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                ?>
                             
                                   <div class="col-md-4">
                                        <div class="partner-items" style="background-image: url('<?php the_post_thumbnail_url( ); ?>')" >
                                            
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
        <!-- End grid container -->


    </div>
    <!-- End listing section -->



</div>
<!-- End wrapper -->


<?php get_footer(); ?>