<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 7:44 PM
 *
 * @package WordPress
 * @subpackage Musicwhore 2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;
?>
<?php get_header(); ?>

	<div class="col-md-12">

	<?php if ( have_posts() ) : ?>
		<header>
			<h2>Releases</h2>
		</header><!-- .page-header -->

		<?php while ( have_posts() ) : // Start the Loop. ?>
			<?php the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<?php TemplateTags::paging_nav(); ?>
	<?php endif; ?>
	</div>

<?php get_footer();
