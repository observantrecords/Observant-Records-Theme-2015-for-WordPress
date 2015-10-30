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

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'wp_enqueue_styles'), 20);

		add_shortcode( 'mailchimp', array( __CLASS__, 'mailchimp_shortcode') );
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

	public static function query_vars( $vars ) {

		$vars[] = 'audio_id';
		return $vars;

	}

	public static function wp_enqueue_scripts() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'facebox-js', TemplateTags::get_cdn_uri() . '/web/js/facebox.js' );
		wp_enqueue_script( 'observantrecords2015-js', get_template_directory_uri() . '/js/observantrecords2015.js', array( 'jquery', 'facebox-js' ) );
	}

	public static function wp_enqueue_styles() {
		wp_enqueue_style( 'google-font-fira-sans', '//fonts.googleapis.com/css?family=Fira+Sans:400,700,400italic,700italic' );
		wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css' );
		wp_enqueue_style( 'observantrecords2015-style', get_stylesheet_uri() );
		wp_enqueue_style( 'facebox', TemplateTags::get_cdn_uri() . '/web/css/facebox.css' );
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

	public static function mailchimp_shortcode( $attributes ) {
		$input = shortcode_atts([
			'group' => 'all',
			'size' => null,
		], $attributes);

		return ($input['size'] == 'short') ? Setup::mailchimp_short_form( $input['group'] ) : Setup::mailchimp_full_form( $input['group'] );
	}

	private static function mailchimp_full_form( $group = 'all')
	{
		$group_output = Setup::mailchimp_group_input( $group );
		$output = <<< OUTPUT
<!-- Begin MailChimp Signup Form -->
<form action="//observantrecords.us11.list-manage.com/subscribe/post?u=a04e90fa99b1b93d418f4ae9d&amp;id=8a11bbe4d2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
	<div class="form-group">
		<label for="mce-EMAIL">Email Address (required)</label>
		<input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL" required="true">
	</div>
	<div class="form-group">
		<label for="mce-FNAME">First Name</label>
		<input type="text" value="" name="FNAME" class="form-control" id="mce-FNAME">
	</div>
	<div class="form-group">
		<label for="mce-LNAME">Last Name</label>
		<input type="text" value="" name="LNAME" class="form-control" id="mce-LNAME">
	</div>

	$group_output

	<p>
		Please format my e-mail as ...
	</p>

	<div class="radio">
		<label for="mce-EMAILTYPE-0">
			<input type="radio" value="html" name="EMAILTYPE" id="mce-EMAILTYPE-0" checked>
			HTML
		</label>
	</div>
	<div class="radio">
		<label for="mce-EMAILTYPE-1">
			<input type="radio" value="text" name="EMAILTYPE" id="mce-EMAILTYPE-1">
			Text
		</label>
	</div>

	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>
	<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_a04e90fa99b1b93d418f4ae9d_8a11bbe4d2" tabindex="-1" value=""></div>

    <div class="form-group">
    	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary btn-lg">
    </div>
</form>

<!--End mc_embed_signup-->
OUTPUT;
		return $output;
	}

	private static function mailchimp_short_form( $group = 'all')
	{
		$group_output = Setup::mailchimp_group_input( $group, 'short' );
		$output = <<< OUTPUT
<!-- Begin MailChimp Signup Form -->
<form action="//observantrecords.us11.list-manage.com/subscribe/post?u=a04e90fa99b1b93d418f4ae9d&amp;id=8a11bbe4d2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
	<div class="form-group">
		<label for="mce-EMAIL">Email Address</label>
		<input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL" required="true">
	</div>

	$group_output

	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>
	<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_a04e90fa99b1b93d418f4ae9d_8a11bbe4d2" tabindex="-1" value=""></div>

    <div class="form-group">
    	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
    </div>
</form>

<!--End mc_embed_signup-->
OUTPUT;
		return $output;
	}

	private static function mailchimp_group_input( $group = 'all', $size = null )
	{
		if ( $group != 'all') {
			switch ( $group ) {
				case 'empty_ensemble':
					$output = <<< EMPTY_ENSEMBLE
	<input type="hidden" value="1" name="group[7993][2]" id="mce-group[7993]-7993-1" />
EMPTY_ENSEMBLE;

					break;
				case 'penzias_and_wilson':
					$output = <<< PENZIAS_AND_WILSON
	<input type="hidden" value="1" name="group[7993][4]" id="mce-group[7993]-7993-2" />
PENZIAS_AND_WILSON;
					break;
				default: // Always Eponymous 4
					$output = <<< EPONYMOUS_4
	<input type="hidden" value="1" name="group[7993][1]" id="mce-group[7993]-7993-0" />
EPONYMOUS_4;

			}

		} else {
			if ($size == 'short')
			{
				$output = <<< SHORT
	<input type="hidden" value="1" name="group[7993][1]" id="mce-group[7993]-7993-0" />
	<input type="hidden" value="1" name="group[7993][2]" id="mce-group[7993]-7993-1" />
	<input type="hidden" value="1" name="group[7993][4]" id="mce-group[7993]-7993-2" />
SHORT;
			} else {
				$output = <<< FULL
	<p>
		I want to get news about ...
	</p>

	<div class="checkbox">
		<label for="mce-group[7993]-7993-0">
			<input type="checkbox" value="1" name="group[7993][1]" id="mce-group[7993]-7993-0" checked />
			Eponymous 4
		</label>
	</div>
	<div class="checkbox">
		<label for="mce-group[7993]-7993-1">
			<input type="checkbox" value="2" name="group[7993][2]" id="mce-group[7993]-7993-1" checked />
			Empty Ensemble
		</label>
	</div>
	<div class="checkbox">
		<label for="mce-group[7993]-7993-2">
			<input type="checkbox" value="4" name="group[7993][4]" id="mce-group[7993]-7993-2" checked />
			Penzias and Wilson
		</label>
	</div>
FULL;
			}
		}

		return $output;
	}

}