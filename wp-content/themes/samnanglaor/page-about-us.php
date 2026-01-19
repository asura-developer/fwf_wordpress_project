<?php get_header( ); ?>

<div class="wrapper">
    <div class="hero" style="background-image: url(<?php the_post_thumbnail_url()?>); background-position: center;">
    <div class="tranbar">   
        <div class="container">
                <div class="hero-title">
                    
                    <div class="bblack"><?php the_title(); ?></div>
                    <div class="bblack"><?php __nt('NATIONAL CONCRETE'); ?></div>

                </div>
        </div>
    </div>    
        
</div>
<!-- End hero section -->

<div class="mission-core">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="mvbox">
                    <div class="mvicon">
                        <img src="<?php the_field('mission-icon'); ?>">
                    </div>
                    <div class="mvtitle">
                        <?php the_field('missiontitle'); ?>
                    </div>
                    <div class="mvdesc">
                        <?php the_field('mission-short-description'); ?>
                    </div>

                </div>
                <!-- end mvbox -->


            </div>
            <!-- end left side -->

            <div class="col-md-6">

                <div class="mvbox">

                    <div class="mvicon">
                        <img src="<?php the_field('core_value_icon'); ?>">
                    </div>

                    <div class="mvtitle">
                        <?php the_field('core_value_title'); ?>
                    </div>

                    <div class="mvdesc">
                        <?php the_field('core_value_short_description'); ?>
                    </div>

                </div>
                <!-- end mvbox -->

            </div>
            <!-- end right -->
        </div>
    </div>
    <!-- End container for vision mission section -->
</div>

<div class="aboutdirector" style="background-image: url('<?php the_field('section_background')?>')">
      <div class="tranbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                       <div class="relativebox">
                            <div class="backdrop-director"></div>
                            <div class="directorframe">
                                <img src="<?php the_field('chairman_image'); ?>">
                            </div>
                       </div>

                    </div>
                    <!-- end left section -->

                    <div class="col-md-8">
                        <div class="director-desc">
                        <?php the_field('director_message'); ?>
                        </div>
                    </div>
                    <!-- end right section -->
                </div>
            </div> 
            <!-- End container -->
        </div>
</div>
<!-- End about director section -->

<div class="aboutusmap">
    <div class="container">
        
        <div class="onemapitem">

            <div class="maptitle">
                 <i class="fas fa-map-marker-alt"></i> <?php the_field('phnom_penh_map_title'); ?>
            </div>
            <div class="mapiframe" id="map">
                
            </div>
            
        </div>

        <div class="onemapitem">
            
            <div class="maptitle">
                 <i class="fas fa-map-marker-alt"></i> <?php the_field('map_title'); ?>
            </div>
            <div class="mapiframe">
                <?php the_field('map_iframe_code'); ?>
            </div>
            
        </div>


    </div>

</div>


   

</div>
<!-- End wrapper -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLlcrmBqRaXHXJEFsXV3nuj_Yr1u1eMsE&callback=initMap" async defer></script>
<script>
      function initMap(){
      // Map options
      var options = {
        zoom:11,
        center:{lat:11.562108,lng:104.888535}
      }

      // New map
      var map = new google.maps.Map(document.getElementById('map'), options);     
      // Array of markers    
      <?php
        // WP_Query arguments
        $args = array(
          'post_type' => 'locator', 
        );
    
        // The Query
        $query = new WP_Query( $args );
        $total = $query->found_posts;

        ?>


        var markers = [
    <?php 
       // The Loop
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
            
                ?>
                    {
                      coords:{lat: <?php echo get_field('latitue'); ?>,lng:<?php echo get_field('long_titute'); ?>},
                      content:''
                    },
         		<?php
    		
    		
    	}
    	echo '];';
    } else {
    	// no posts found
    }
    
    // Restore original Post Data
    wp_reset_postdata();
    ?>
    // Loop through markers
      for(var i = 0;i < markers.length;i++){
        // Add marker
        addMarker(markers[i]);
      }

      // Add Marker Function
      function addMarker(props){
        var marker = new google.maps.Marker({
          position:props.coords,
          map:map,
          //icon:props.iconImage
        });

        // Check for customicon
        if(props.iconImage){
          // Set icon image
          marker.setIcon(props.iconImage);
        }

        // Check content
        if(props.content){
          var infoWindow = new google.maps.InfoWindow({
            content:props.content
          });

          marker.addListener('click', function(){
            infoWindow.open(map, marker);
          });
        }
      }
    }
       
     
</script>

<?php get_footer(); ?>