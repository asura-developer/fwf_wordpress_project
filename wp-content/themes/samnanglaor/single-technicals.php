<?php get_header(); ?>
<?php $ct = get_the_terms( get_the_ID() , 'technical_categories' ); ?>
<?php
   $allCurrentTerms = array();
   for($a = 0 ; $a < count($ct) ; $a++){
       $allCurrentTerms[$a] = $ct[$a]->term_id;
   }

?>
<?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post(); 
?>

<section id="technical-detail">

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
        
   <!-- End listing tech on left sidebar  -->

    <div class="col-md-9">

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
                    <div class="section-title"><?php __nt('RELATED TECHNICAL'); ?></div>
                    <div class="linegray"></div> 
                    <div class="row">
                        <?php
                            // WP_Query arguments
                            $args = array(
                                'posts_per_page'         => '3',
                                'post_type'              => array( 'technical' ),
                                'post__not_in' => array( get_the_ID(), ),
                                'tax_query' => array(
                                    array(
                                    'taxonomy' => 'technical_categories',
                                    'field' => 'term_id',
                                    'terms' => $allCurrentTerms
                                     )
                                )
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
            <!-- End col-md-9 -->
          </div>
           <!-- End row -->
                    



        </div> 

    </section>                
                   


<?php
                } // end while
            } // end if
?>

<?php get_footer(); ?>