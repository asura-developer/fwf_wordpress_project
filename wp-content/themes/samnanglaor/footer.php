<section id="footer">

    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <?php if(qtranxf_getLanguage() == 'kh'){dynamic_sidebar( 'footer-1-kh' );}else{dynamic_sidebar( 'footer-1' );} ?>
            </div>

            <div class="col-md-6">
                 <?php if(qtranxf_getLanguage() == 'kh'){dynamic_sidebar( 'footer-2-kh' );}else{dynamic_sidebar( 'footer-2' );} ?>
            </div>

        </div>
        <!-- end row   -->
    </div>
    <!-- end container -->

</section>


</div><!-- #page -->

<script src="<?php echo themeplugin_uri . 'owl/dist/owl.carousel.min.js'; ?>"></script>
<script>
	j('.searchbar').click(function(){
		j('.searchform').css('display','flex');
	});


    j('.closesearch').click(function(){
        j('.searchform').css('display','none');
    });
</script>	


<?php wp_footer();   ?>

</body>
</html>
