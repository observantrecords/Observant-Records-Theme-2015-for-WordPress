<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 3:11 PM
 *
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

const WP_TEXT_DOMAIN = 'observantrecords2015';

if (!function_exists( __NAMESPACE__ . '\\autoload' )) {
	function autoload( $class_name )
	{
		$class_name = ltrim($class_name, '\\');
		if ( strpos( $class_name, __NAMESPACE__ ) !== 0 ) {
			return;
		}

		$class_name = str_replace( __NAMESPACE__, '', $class_name );

		$path = get_template_directory() . '/lib' . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';

		require_once($path);
	}
}

spl_autoload_register(__NAMESPACE__ . '\\autoload');
Setup::init();
MailChimpShortcode::init();
