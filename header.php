<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js <?php if(is_home()|| is_front_page()): echo "front-page-home"; endif?>" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a id="skippy" class="sr-only sr-only-focusable" href="#content"><div class="container"><span class="skiplink-text"><?php _e( 'Skip to content', 'odin' ); ?></span></div></a>


	<nav class="navbar navbar-default navbar-custom navbar-fixed-top <?php if(is_admin_bar_showing()):echo 'has-admin-bar';endif; ?>" role="navigation">
		<div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header page-scroll">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>

	            <!-- Shows the logo or site name-->
	            <?php if ( get_theme_mod( 'responsivepp_logo' ) ) : ?>
				    <div class='site-logo'>
				        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img class="img-logo" src='<?php echo esc_url( get_theme_mod( 'responsivepp_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
				    </div>
				<?php else : ?>
				    <hgroup>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
				    </hgroup>
				<?php endif; ?>
	        </div>
	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	        <!-- header menu -->
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main-menu',
					'depth'          => 1,
					'container'      => false,
					'menu_class'     => 'nav navbar-nav navbar-right',
					'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
					'walker'         => new Odin_Bootstrap_Nav_Walker()
				)
			);
		?>
		</div>

		</div>
	</nav><!-- .navbar-collapse -->

	<?php if(is_front_page() || is_home() || (!has_post_thumbnail())) :?>
		<header class="intro-header <?php if(!is_home() && !is_front_page()): echo "out-of-home"; endif?>" style="background-image: url('<?php header_image(); ?>')">
	<?php elseif(is_single()): ?>
		<?php $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumbnail-size', true); ?>
		<!-- if has no thumbnail, change the style-->
		<header class="intro-header" style="background-image: url('<?php echo $thumb_url[0] ?>')">

	<?php endif ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                    <!-- if is home page, show the site name on title-->
                    <?php if(is_front_page() || is_home()) :?>
                        <h1><?php echo get_bloginfo('name'); ?></h1>
                        <hr class="small">
                        <span class="subheading"><?php bloginfo( 'description' ); ?></span>
                    <!-- if is single page/page show the title page-->    
                    <?php elseif(is_single() || is_page()): ?>
                    	<?php the_title( '<h1 class="post-title">', '</h1>' );?>
                        <hr class="small">
                        <span class="subheading"><?php the_excerpt(); ?></span>
                    <?php endif?>
                    
                    </div>
                </div>
            </div>
        </div>
    </header>

	<div id="wrapper" class="container <?php if(!is_home() && !is_front_page()): echo "out-of-home"; endif?>">
		<div class="row">
