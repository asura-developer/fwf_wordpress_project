<!doctype html>
<html <?php language_attributes(); session_start(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&family=Roboto:ital,wght@0,300;0,500;1,300;1,400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo themeplugin_uri . 'owl/dist/assets/owl.carousel.min.css'; ?>">
	<link rel="stylesheet" href="<?php echo themeplugin_uri . 'owl/dist/assets/owl.theme.default.min.css'; ?>"> 
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script> function x(selector) { return document.querySelector(selector) } var j = (el) => jQuery(el); </script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
$search = '';
if(isset($_GET['searchText'])){
    $search = $_GET['searchText'];
}
?>
<div class="searchform" style="display: none;">
	<div class="closesearch">X</div>
	<form action="<?php echo get_home_url() . '/search'?>" method="get">
		<input type="text" name="searchText" placeholder="<?php __nt('Search ... '); ?>" autocomplete="off" value="<?php if(isset($_GET['searchText'])){echo $_GET['searchText'];}?>">
		<button><i class="fas fa-search"></i></button>
	</form>
</div>


<div id="page" class="site" ajax="<?php echo admin_url( 'admin-ajax.php' ) ?>">
	<div class="header" home="<?php echo get_home_url() ?>">
	 
	  
		<div class="main-head">
			<div class="container">		
					<a class="left logo" href="<?php echo get_home_url();?>">
						<img src="<?php echo get_home_url() . '/wp-content/uploads/2020/10/logo-cut.jpg'?>" >
						<h2><?php __nt('NATIONAL CONCRETE')?></h2>
					</a>

					<div class="right">
							<?php dynamic_sidebar( 'header-right' ); ?>     
							<div class="dropdown">

								<button 
									class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php if(qtranxf_getLanguage() == 'en'){?>
								​​​​    	<div id="currentFlag" style='background: url(<?php echo get_stylesheet_directory_uri() . '/english-small.jpg'; ?>)'></div>	English
									<?php }else{?>
										<div id="currentFlag" style='background: url(<?php echo get_stylesheet_directory_uri() . '/khmer-small.jpg'; ?>)'></div>	ភាសាខ្មែរ
									<?php } ?>	
							    </button>

								<div lang="<?php if(qtranxf_getLanguage() == 'en'){echo get_Langauge_url('kh');}else{echo get_Langauge_url('en');} ?>" 
								    class="dropdown-menu switcher" aria-labelledby="dropdownMenu2">
									<button class="dropdown-item" type="button">
										<?php if(qtranxf_getLanguage() == 'en'){?>
									​​​​    	<div id="currentFlag" style='background: url(<?php echo get_stylesheet_directory_uri() . '/khmer-small.jpg'; ?>)'></div>	ភាសាខ្មែរ
										<?php }else{?>
										    <div id="currentFlag" style='background: url(<?php echo get_stylesheet_directory_uri() . '/english-small.jpg'; ?>)'></div>	English
										<?php } ?>	
									</button>
								</div>

							</div>
							<!-- ENd drop down -->
					</div>
			</div>
			<div class="ncnav">
			    <div class="container">
					<div class="pri-navigation">
							<?php ubermenu( 'main' , array( 'menu' => 2 ) ); ?>
					</div>
					<div class="searchbar">
						<i class="fas fa-search"></i>
					</div>
				</div>	
			</div>
		</div>
		<!-- End main head -->
    </div>
	<!-- End class header -->

	<script>
	
	j('.switcher').click(function(){
		window.location.replace(j(this).attr('lang'));
	});

	</script>
