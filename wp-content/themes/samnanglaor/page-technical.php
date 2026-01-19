<?php get_header(); ?>

<div class="wrapper technical">
    <div class="container">
       <div class="row">
        <div class="col-md-3">
           <div class="list-terms">
                <?php 
                $terms = get_terms( array(
                    'taxonomy'   => 'technical_categories', // Swap in your custom taxonomy name
                    'hide_empty' => false, 
                ));

                // echo dd($terms);
                
                $parent = 1;
                for($i = 0 ; $i < count($terms) ;  $i ++){
                    if($terms[$i]->parent == 0){
                      echo '<div class="parent-wrap">';

                            echo '<div class="parent">';  
                              echo '<a href="' . get_term_link( $terms[$i]->term_id, 'technical_categories' ) . '">';
                                 echo  $parent . '.'. $terms[$i]->name;
                              echo '</a>';   
                            echo '</div>';

                                $subterms = get_term_children($terms[$i]->term_id, 'technical_categories');
                            
                                for($j = 0 ; $j < count($subterms) ; $j ++){
                                    $singleTerm = get_term_by('id', $subterms[$j], 'technical_categories');
                                    
                                    echo '<div class="sub-term">';
                                      echo '<a href="' . get_term_link( $subterms[$j], 'technical_categories' ) . '">';
                                         echo $parent . '.' . ($j + 1) . ' '. $singleTerm->name;
                                      echo '</a>';  
                                    echo '</div>';
                                }

                      echo '</div>';
                      //   End parent wrap

                      $parent++;     
                    }else{ continue; }



                }


                ?>
           
           </div>
           <!-- End List box -->
        </div>
        <!-- End col-md-3  -->
        
        <div class="col-md-9">
             <div class="row">
                <?php
                // WP_Query arguments
                $args = array(
                    'post_type'              => array( 'technicals' ),
                    'posts_per_page'         => '-1',
                );

                // The Query
                $query2 = new WP_Query( $args );

                // The Loop
                if ( $query2->have_posts() ) {
                    while ( $query2->have_posts() ) {
                        $query2->the_post();
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
                                                    
                                                    <div class="smalltitle"><?php the_title(); ?></div>
                                                    <div class="smallpostdate"><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></div>
                                                    
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
        <!-- End Row -->
    </div>
    <!-- End wrap container -->

</div>


<?php get_footer(); ?>