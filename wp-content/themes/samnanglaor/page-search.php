<?php
get_header();
$search = '';
if(isset($_GET['searchText'])){
    $search = $_GET['searchText'];
}
// WP_Query arguments
$args = array(
	's'                   => $search,
	'post_type'              => array( 'post','project','technical' ),
);
// The Query
$query = new WP_Query( $args );
?>



<div class="bread">
    <div class="container">
        <div class="left">
            <?php __nt('Searching for : '); echo $_GET['searchText']; ?>
        </div>   

        <div class="right">
            
            <?php __nt('Found: '); echo $query->found_posts;?>  
        </div> 
    </div>
</div>
    

<div class="container">
    <div class="detail-padding">
    <div class="row" id="prolist"> 
     
          <?php
          
           

            // The Loop
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
            ?>

                <div class="col-md-12 search-result-box">
                    <a href="<?php the_permalink( ); ?>">
                        <div class="srb-title"><?php the_title(); ?></div>
                        <div class="srb-date"><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></div>
                    </a>
                </div>

            <?php
                }
            } else {
                echo '<div class="center-center text-center">';
                    __nt('No Result');
                echo '</div>';
            }

            // Restore original Post Data
            wp_reset_postdata();
          
          ?>
    </div>   
    </div>

</div>

<?php

get_footer();
