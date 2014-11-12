<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 9:31 PM
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

class Setup {

	public function __construct() {

	}

	public static function init() {
		add_filter( 'wp_page_menu_args', array( __CLASS__, 'wp_page_menu_args' ) );

		add_filter( 'wp_title', array( __CLASS__, 'wp_title' ), 10, 2 );

		add_filter('query_vars', array( __CLASS__, 'query_vars'));

		add_action( 'after_setup_theme', array( __CLASS__, 'after_setup_theme' ) );

		add_action( 'init', array( __CLASS__, 'menus_init' ) );

		add_action( 'init', array( __CLASS__, 'rewrite_init' ) );

		add_action( 'widgets_init', array( __CLASS__, 'widgets_init' ) );

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'wp_enqueue_scripts' ) );
	}

	public static function after_setup_theme() {
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );


	}

	public static function widgets_init() {

		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Main sidebar that appears on the left.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Content Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Additional sidebar that appears on the right.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer Widget Area', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears in the footer section of the site.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Home Page Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-home',
			'description'   => __( 'Appears on the main index page only.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'About Page Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-about',
			'description'   => __( 'Appears on the About page only.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Contact Page Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-contact',
			'description'   => __( 'Appears on the Contact page only.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
	}

	public static function menus_init() {

		register_nav_menu('primary', 'Primary Menu');
		register_nav_menu('footer-artists', 'Footer: Artists');
		register_nav_menu('footer-info', 'Footer: More Info');

	}

	public static function rewrite_init() {

		add_rewrite_rule( 'audio/([^/]*)', 'index.php?pagename=audio&audio_id=$matches[1]', 'top' );

	}

	public function query_vars( $vars ) {

		$vars[] = 'audio_id';
		return $vars;

	}

	public static function wp_enqueue_scripts() {
		wp_enqueue_style( 'observantrecords2015-style', get_stylesheet_uri() );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	public static function wp_page_menu_args( $args ) {
		$args['show_home'] = false;
		$args['container'] = false;
		$args['menu_class'] = 'links';
		return $args;
	}

	public static function wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', WP_TEXT_DOMAIN ), max( $paged, $page ) );
		}

		return $title;
	}


}