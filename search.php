<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 10/15/2014
 * Time: 11:02 AM
 *
 * @package WordPress
 * @subpackage Musicwhore 2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;
?>
<?php get_header(); ?>

	<div class="col-md-8">
		<?php if ( have_posts() ) : ?>
			<header>
				<h2><?php printf( __( 'Search Results for: %s', WP_TEXT_DOMAIN ), get_search_query() ); ?></h2>
			</header><!-- .archive-header -->

			<?php while ( have_posts() ) : // Start the Loop. ?>
				<?php the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php TemplateTags::paging_nav(); ?>
		<?php endif; ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer();
