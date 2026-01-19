<?php get_header(); ?>

<div class="wrapper">
    <div class="hero" style="background-image: url(<?php the_post_thumbnail_url()?>); background-position: bottom;">
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
                                'post_type'              => array( 'project' ),
                                'posts_per_page'         => '-1',
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
        <!-- End grid container -->


    </div>
    <!-- End listing section -->



</div>
<!-- End wrapper -->


<?php get_footer(); ?>