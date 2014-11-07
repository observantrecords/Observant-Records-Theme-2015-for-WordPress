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

	<div class="col-md-8">
	<?php if ( have_posts() ) : ?>
		<header class="archive-header">
			<h2 class="archive-title">
				<?php //Queue the first post, that way we know what author we're dealing with (if that is the case). We reset this later so we can run the loop properly with a call to rewind_posts(). ?>
				<?php the_post(); ?>
				<?php printf( __( 'All posts by %s', WP_TEXT_DOMAIN ), get_the_author() ); ?>
			</h2>
			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div class="author-description"><?php the_author_meta( 'description' ); ?></div>
			<?php endif; ?>
		</header><!-- .archive-header -->

		<?php //Since we called the_post() above, we need to rewind the loop back to the beginning that way we can run the loop properly, in full. ?>
		<?php rewind_posts(); ?>
		<?php while ( have_posts() ) : // Start the loop ?>
			<?php the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<?php TemplateTags::paging_nav(); ?>
	<?php endif; ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer();
