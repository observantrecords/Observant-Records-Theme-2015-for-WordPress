<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 10/14/2014
 * Time: 10:35 AM
 *
 * @package WordPress
 * @subpackage Musicwhore2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

get_header();
?>

<div class="col-md-8">
	<?php
	if ( have_posts() ) :
		// Start the Loop.
		while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );

			// Previous/next post navigation.
			TemplateTags::post_nav();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
	endif;
	?>
</div>


<?php
get_sidebar();
get_footer();
