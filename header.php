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
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/manifest.json">
		<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/favicon.ico">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/mstile-144x144.png">
		<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/assets/graphics/favicon/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		<?php wp_head(); ?>
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
		<![endif]-->
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
