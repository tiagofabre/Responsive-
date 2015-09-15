<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since  2.2.0
	 *
	 * @return void
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);

		register_sidebar(
		array(
			'name' => 'Second Sidebar',
			'id' => 'second-sidebar',
			'description' => 'Site secondary Sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );
	wp_enqueue_style( 'blog', $template_url . '/assets/css/main.min.css', array(), null);

	// jQuery.
	wp_enqueue_script( 'jquery2', $template_url . '/assets/js/jquery.min.js', array(), null, true  );

	//Fonts
	wp_enqueue_style( 'blog', $template_url . '/assets/css/main.min.css', array(), null);
	wp_enqueue_style( 'cleanblog-lora', 'http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' );
	wp_enqueue_style( 'cleanblog-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );

		//Clean Blog - base
		wp_enqueue_script( 'clean-blog', $template_url . '/assets/js/clean-blog.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );

		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

	}

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';


/**
 * Customizer API - logo section
 */
function responsivepp_logo_customizer( $wp_customize ) {

	//Section logo
    $wp_customize->add_section( 'responsivepp_logo_section' , array(
    'title'       => __( 'Logo', 'odin' ),
    'priority'    => 30,
    'description' => __('Upload a logo to replace the default site name and description in the header', 'odin'),
	) );

    //Setting logo
    $wp_customize->add_setting( 'responsivepp_logo',array(
    	'sanitize_callback'=>'esc_url_raw'
    	) 
    );

    //Control logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'responsivepp_logo', array(
    'label'    => __( 'Logo', 'odin' ),
    'section'  => 'responsivepp_logo_section',
    'settings' => 'responsivepp_logo',
	) ) );
}
add_action( 'customize_register', 'responsivepp_logo_customizer' );

/**
 * Customizer API - Column section
 */
function responsivepp_layout_customize($wp_customize){
    
    //layout section
    $wp_customize->add_section('layout_scheme', array(
        'title'    => __('Layout', 'odin'),
        'description' => __('Layout scheme of the site', 'odin'),
        'priority' => 120,
    ));

    //Setting layout
    $wp_customize->add_setting('columns',
	    array(
	    	'default' => 'one_column',
	    	'sanitize_callback' => 'responsivepp_sanitize_prefix'
	    )
	);
	
	//Control Layout
	$wp_customize->add_control('columns',
	    array(
	        'type' => 'radio',
	        'label' => __('Column scheme','odin'),
	        'section' => 'layout_scheme',
	        'choices' => array(
	            'one_column' => __('one column','odin'),
	            'two_column' => __('two columns','odin'),
	            'three_column' => __('three columns','odin'),
	        ),
	    )
	);
}
add_action('customize_register', 'responsivepp_layout_customize');

/**
 * 	Filter to add searchbox in the nav header, if it is enabled on customizer
 **/
function responsivepp_show_searchbox( $items, $args ) {
	
	//customizer option on navigation section
	$searchbox = get_theme_mod( 'responsivepp_searchbox', 1 ); 
	
	if($searchbox){
    	if( $args->theme_location == 'main-menu' )
    	    return $items.responsivepp_search_bar();
	}
    return $items;
}
add_filter('wp_nav_menu_items','responsivepp_show_searchbox', 10, 2);

/**
 * Add check box on customizer to enable/disable searchbox on navigation menu
 * 
 */
function responsivepp_searchbox_customize($wp_customize){

	$wp_customize->add_setting( 
		'responsivepp_searchbox', 
		array(
    		'default'        	=> 0,
    		'sanitize_callback' => 'responsivepp_sanitize_do_nothing'
		) 
	);

	$wp_customize->add_control(
		'responsivepp_searchbox',
		array(
			'section'   => 'nav',
			'label'     => __('Display search box','odin'),
			'type'      => 'checkbox'
		)
	);
}
add_action('customize_register', 'responsivepp_searchbox_customize');

/**
 * Register widget areas.
 *
 */
function responsivepp_footer_widgets() {

	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 1', 'odin' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" >',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 2', 'odin' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 3', 'odin' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

}
add_action( 'widgets_init', 'responsivepp_footer_widgets' );

/**
 * Add prefix to data.
 * 
 * @param sanitize data
 * 
 * @return the same object add with a prefix 
 */
function responsivepp_sanitize_prefix($param){
	$param = trim($param);

	return 'responsivepp_' .$param;
}

/**
 * Add prefix to data.
 * 
 * @param sanitize data
 * 
 * @return the same object add with a prefix 
 */
function responsivepp_sanitize_do_nothing($param){
	return $param;
}

/**
 * Add some default image to header.
 */

$args = array(
	'default-image' => get_template_directory_uri() . '/assets/images/home-bg.jpg',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );
