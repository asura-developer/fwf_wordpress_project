<?php get_header(); ?>
    <div class="wrapper">
        <div class="mapsection">
        <?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post(); 
            ?>
            
            <div class="container">
                
                <div class="row">
                        <div class="col-md-12">
                            <div class="maptitle"  style="text-align: center;">
                                 <i class="fas fa-map-marker-alt"></i> <?php the_field('phnom_penh_map_title',87); ?>
                                 
                            </div>
                            <div class="map-detail" style="text-align: center;">
                                    <?php the_field('phnom_penh_address'); ?>
                            </div>
                            <div class="onemap">
                                <?php the_field('phnom_penh_map'); ?>    
                            </div>
                            
                        </div>
                            
                        <div class="col-md-12">
                            <div class="maptitle"  style="text-align: center;">
                                 <i class="fas fa-map-marker-alt"></i> <?php the_field('map_title',87); ?>
                            </div>
                            <div class="map-detail"  style="text-align: center;">
                                    <?php the_field('sihanoukville_address'); ?>
                            </div>
                            <div class="onemap">
                               <?php the_field('sihanoukville_map'); ?>    
                            </div>
                        </div>    
                </div>
            </div>
            
            
            <?php
                   

                } // end while
            } // end if
            ?>
        </div>
        <!-- End map section -->

        <div class="contact-form">

             <div class="container">
                    <div class="center-center">
                        <div class="section-title-center"><?php __nt('ENQUIRY FORM') ?></div>
                        <div class="linegray"></div>
                    </div>      
                    
                    <div class="form">
                        <input type="text" name="yourname" placeholder="<?php __nt('Your name'); ?>" class="form-control my-control" required></input>
                        <input type="text" name="yousubject" placeholder="<?php __nt('Subject'); ?>" class="form-control my-control" required ></input>
                        <input type="email" name="youremail" placeholder="<?php __nt('Your email'); ?>" class="form-control my-control"required ></input>
                        <input type='tel' name="yourphone" placeholder="<?php __nt('Your Phone'); ?>" class="form-control my-control" required ></input>
                        <textArea placeholder="<?php __nt('Your message'); ?>" rows="4" class="form-control my-control"></textArea>
                        <button class="btn btn-primary my-control"><i class="fas fa-paper-plane"></i> <?php __nt('Send'); ?></button>
                    </div>


                    <!-- Contact form 7 shortcode -->
             </div>   
             <!-- End container -->

        </div>
        <!-- End contact form -->


    </div>


               


    </div>


<?php get_footer(); ?>