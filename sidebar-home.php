<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 5:07 PM
 *
 * @package WordPress
 * @subpackage Musicwhore2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;
?>
<div class="col-md-4">
	<?php if ( is_active_sidebar( 'sidebar-home' ) ) : ?>
	<?php dynamic_sidebar( 'sidebar-home' ); ?>
	<?php endif; ?>
</div>