<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 7:43 PM
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
			<h2><?php printf( __( 'Category: %s', WP_TEXT_DOMAIN ), single_cat_title( '', false ) ); ?></h2>
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
