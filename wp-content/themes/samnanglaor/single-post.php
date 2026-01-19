<?php get_header(); ?>

<?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post(); 
?>

    <section>

        <div class="container">
            <div class="detail-padding">

                <div class="detail-title">
                    <?php the_title(); ?>
                </div>           
                
                <div class="detail-date">
                    <i class="far fa-calendar"></i> <?php echo get_the_date(); ?> 
                </div>   
                
                <div class="detail-content">

                    <div class="feature-detail">
                        <img src="<?php the_post_thumbnail_url();?>">
                    </div>

                    <div class="from-editor">
                        <?php the_content(); ?>
                    </div>      

                </div>

                <div class="related-news">
                    <div class="section-title"><?php __nt('RELATED NEWS'); ?></div>
                    <div class="linegray"></div> 
                    <div class="row">
                        <?php
                            // WP_Query arguments
                            $args = array(
                                'posts_per_page'         => '3',
                                'post_type'              => array( 'post' ),
                                'post__not_in' => array( get_the_ID(), ),
                            );

                            // The Query
                            $query = new WP_Query( $args );

                            // The Loop
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                            ?>
                               <div class="col-md-4">
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
                                                    
                                                </div>
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
                    

                </div>    


            </div>
            <!-- End detail padding -->

                    



        </div> 

    </section>                
                   


<?php
                } // end while
            } // end if
?>

<?php get_footer(); ?>