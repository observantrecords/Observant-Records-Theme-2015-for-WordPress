<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 10/14/2014
 * Time: 12:15 PM
 *
 * @package WordPress
 * @subpackage Musicwhore 2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo TemplateTags::get_cdn_uri(); ?>/web/css/facebox.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/typography.css">
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/layout.css">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo TemplateTags::get_cdn_uri(); ?>/web/js/facebox.js"></script>
		<script type="text/javascript">
			var facebox_options = {
				closeImage: '<?php echo TemplateTags::get_cdn_uri(); ?>/web/images/closelabel.gif',
				loadingImage: '<?php echo TemplateTags::get_cdn_uri(); ?>/web/images/loading.gif'
			};
			(function ($) {
				$(function () {
					$('a[rel*=facebox]').facebox(facebox_options);
				});
			})(jQuery);
		</script>
	</head>
	<body>

	<div id="masthead">
		<div class="container">
			<header id="logo" class="col-md-6">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo __('Home', WP_TEXT_DOMAIN); ?>" rel="home">
					<img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="[<?php bloginfo( 'name' ); ?>]" title="[<?php bloginfo( 'name' ); ?>]" id="observant-records-logo" />
				</a>
			</header>

			<nav id="nav-header" class="col-md-6">
				<?php $nav_menu_args = array( 'theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s links">%3$s</ul>' ); ?>
				<?php if ( function_exists( 'bootstrap_page_menu' ) ) { $nav_menu_args[ 'fallback_cb' ] = 'bootstrap_page_menu'; } ?>
				<?php wp_nav_menu( $nav_menu_args ); ?>
			</nav>

		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
