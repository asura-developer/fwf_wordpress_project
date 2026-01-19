<?php get_header(); ?>

<div class="container" style="font-family: inherit; text-align: center; margin-top: 50px; margin-bottom: 80px;">
  <h2 style="font-family: siemreap; font-weight: bold; color: #c70000;">
      <?php __nt( 'Something went wrong. The message has not sent' )?>
      <br>
  </h2>
  <a href="<?php echo get_home_url();?>"  style="font-family: inherit; text-decoration: underline;  color: #7f8583;">
    <?php __nt( '<= Back to homepage'); ?>
  </a>
  
  
</div>



<?php get_footer(); ?>