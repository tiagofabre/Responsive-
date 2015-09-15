<?php
/**
 * Custom template tags for Odin.
 *
 * @package Odin
 * @since 2.2.0
 */

if ( ! function_exists( 'odin_classes_page_full' ) ) {

	/**
	 * Classes page full.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_full() {
		return 'col-md-12';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar' ) ) {

	/**
	 * Classes page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar() {
		return 'col-md-9';
	}
}

if ( ! function_exists( 'responsivepp_classes_page_sidebar_aside' ) ) {

	/**
	 * Classes aside of page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function responsivepp_classes_page_sidebar_aside() {
		
		$example_position = get_theme_mod( 'columns', 'responsivepp_one_column' ); 
		
		if($example_position =='responsivepp_two_column') : 
			$offset = "col-lg-offset-1";
		else :
			$offset = "col-lg-offset-0";
		endif;
		
		return 'col-lg-3  hidden-xs hidden-md hidden-sm hidden-print widget-area '. $offset;
	}
}

if ( ! function_exists( 'odin_posted_on' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 *
	 * @return void
	 */
	function odin_posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . __( 'Sticky', 'odin' ) . ' </span>';
		}

		// Set up and print post meta information.
		printf( '<span class="entry-date">%s <time class="entry-date" datetime="%s">%s</time></span> <span class="byline">%s <span class="author vcard"><a class="url fn n" href="%s" rel="author">%s</a></span>.</span>',
			__( 'Posted in', 'odin' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			__( 'by', 'odin' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}
}

if ( ! function_exists( 'responsivepp_paging_nav' ) ) {

	/**
	 * Print HTML with next/previous button.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function responsivepp_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<ul class="pager">
		<?php if ( get_next_posts_link() ) : ?>
			<li class="next"><?php next_posts_link( __( 'Older posts', 'odin' ) ); ?></li>
		<?php endif; ?>
		<?php if ( get_previous_posts_link() ) : ?>
			<li class="previous"><?php previous_posts_link( __( 'Newer posts', 'odin' ) ); ?></li>
		<?php endif; ?>
	</ul>
	<?php
	}
}

if ( ! function_exists( 'responsivepp_column_handler' ) ) {
	/**
	 * Print the class of main content, to set one, to or three columns
	 *
	 * @since 1.0
	 *
	 * @return string classes name
	 */
	function responsivepp_column_handler() {

		$example_position = get_theme_mod( 'columns', 'responsivepp_one_column'); 
		if( $example_position != '' ) {
	        switch ( $example_position ) {
	            case 'responsivepp_one_column':
	                return "col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1";
	                break;
	            case 'responsivepp_two_column':
	                return "col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1";
	                break;
	            case 'responsivepp_three_column':
	                return "col-lg-6 col-lg-offset-0 col-md-10 col-md-offset-1";
	                break;
	            default:
	            	return "col-lg-6 col-lg-offset-0 col-md-10 col-md-offset-1";
	                break;
	        }
	    }
	}
}

if ( ! function_exists( 'responsivepp_sidebar_handler' ) ) {

	/**
	 * Call the right the sidebar, based on customizer API
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function responsivepp_sidebar_handler() {

		$example_position = get_theme_mod( 'columns', 'responsivepp_one_column' ); 
		
		//if the setting is three columns, show the right column
		if($example_position =='responsivepp_three_column') : 
			get_sidebar('right'); 
		endif;
		
		//if the setting is to three columns or two columns, show the registed column
		if($example_position !='responsivepp_one_column') : 
			get_sidebar('second-sidebar'); 
		endif;
	}
}

if ( ! function_exists( 'responsivepp_search_bar' ) ) {

	/**
	 * Show the Searchbar in the header
	 *
	 * @since 1.0
	 *
	 * @return string Input html
	 */
	function responsivepp_search_bar() {

		return 
		'<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-37">
		    <form method="get" id="searchform" class="form-inline" action='. esc_url( home_url( '/' ) ).' role="search">
			    <input type="search" class="form-control input-search" placeholder='.__("Search...","odin").' name="s" id="s" />
		  	</form>
		</li>';
	}
}



