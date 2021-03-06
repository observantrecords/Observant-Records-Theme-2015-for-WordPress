<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 9:31 PM
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

class Setup
{

	public function __construct()
	{

	}

	public static function init()
	{
		add_filter('wp_page_menu_args', array(__CLASS__, 'wp_page_menu_args'));

		add_filter('wp_title', array(__CLASS__, 'wp_title'), 10, 2);

		add_filter('query_vars', array(__CLASS__, 'query_vars'));

		add_filter('metaslider_resized_image_url', array(__CLASS__, 'metaslider_protocol_relative_urls'));

		add_filter('wp_calculate_image_srcset', array(__CLASS__, 'image_srcset_protocol_relative_urls'));

		add_action('after_setup_theme', array(__CLASS__, 'after_setup_theme'));

		add_action('init', array(__CLASS__, 'menus_init'));

		add_action('init', array(__CLASS__, 'rewrite_init'));

		add_action('widgets_init', array(__CLASS__, 'widgets_init'));

		add_action('wp_enqueue_scripts', array(__CLASS__, 'wp_enqueue_scripts'));

		add_action('wp_enqueue_scripts', array(__CLASS__, 'wp_enqueue_styles'), 20);
	}

	public static function after_setup_theme()
	{
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		));


	}

	public static function widgets_init()
	{

		register_sidebar(array(
			'name' => __('Primary Sidebar', WP_TEXT_DOMAIN),
			'id' => 'sidebar-1',
			'description' => __('Main sidebar that appears on the left.', WP_TEXT_DOMAIN),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('Content Sidebar', WP_TEXT_DOMAIN),
			'id' => 'sidebar-2',
			'description' => __('Additional sidebar that appears on the right.', WP_TEXT_DOMAIN),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('Footer Widget Area', WP_TEXT_DOMAIN),
			'id' => 'sidebar-3',
			'description' => __('Appears in the footer section of the site.', WP_TEXT_DOMAIN),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('Home Page Sidebar', WP_TEXT_DOMAIN),
			'id' => 'sidebar-home',
			'description' => __('Appears on the main index page only.', WP_TEXT_DOMAIN),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('About Page Sidebar', WP_TEXT_DOMAIN),
			'id' => 'sidebar-about',
			'description' => __('Appears on the About page only.', WP_TEXT_DOMAIN),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('Contact Page Sidebar', WP_TEXT_DOMAIN),
			'id' => 'sidebar-contact',
			'description' => __('Appears on the Contact page only.', WP_TEXT_DOMAIN),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
	}

	public static function menus_init()
	{

		register_nav_menu('primary', 'Primary Menu');
		register_nav_menu('footer-artists', 'Footer: Artists');
		register_nav_menu('footer-info', 'Footer: More Info');

	}

	public static function rewrite_init()
	{

		add_rewrite_rule('audio/([^/]*)', 'index.php?pagename=audio&audio_id=$matches[1]', 'top');

	}

	public static function query_vars($vars)
	{

		$vars[] = 'audio_id';
		return $vars;

	}

	public static function wp_enqueue_scripts()
	{
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		wp_enqueue_script('bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array('jquery'));
		wp_enqueue_script('facebox-js', TemplateTags::get_cdn_uri() . '/web/js/facebox.js');
		wp_enqueue_script('observantrecords2015-js', get_template_directory_uri() . '/assets/js/observantrecords2015.js', array('jquery', 'facebox-js'));
	}

	public static function wp_enqueue_styles()
	{
		wp_enqueue_style('google-font-fira-sans', '//fonts.googleapis.com/css?family=Fira+Sans:400,700,400italic,700italic');
		wp_enqueue_style('bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');
		wp_enqueue_style('observantrecords2015-style', get_stylesheet_uri());
		wp_enqueue_style('facebox', TemplateTags::get_cdn_uri() . '/web/css/facebox.css');
	}

	public static function wp_page_menu_args($args)
	{
		$args['show_home'] = false;
		$args['container'] = false;
		$args['menu_class'] = 'links';
		return $args;
	}

	public static function wp_title($title, $sep)
	{
		global $paged, $page;

		if (is_feed()) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo('name', 'display');

		// Add a page number if necessary.
		if ($paged >= 2 || $page >= 2) {
			$title = "$title $sep " . sprintf(__('Page %s', WP_TEXT_DOMAIN), max($paged, $page));
		}

		return $title;
	}

	public static function jetpack_remove_share()
	{
		remove_filter('the_content', 'sharing_display', 19);
		remove_filter('the_excerpt', 'sharing_display', 19);
		if (class_exists('Jetpack_Likes')) {
			remove_filter('the_content', array(Jetpack_Likes::init(), 'post_likes'), 30, 1);
		}
	}

	public static function metaslider_protocol_relative_urls($cropped_url, $orig_url = null) {
		return str_replace('http://', '//', $cropped_url);
	}

	public static function image_srcset_protocol_relative_urls( $sources ) {
		foreach ( $sources as $s => $source ) {
			if ( isset( $source['url'] ) ) {
				$sources[$s]['url'] = set_url_scheme( $source['url'], null);
			}
		}
		return $sources;
	}

}