<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 10/14/2014
 * Time: 10:35 AM
 *
 * @package WordPress
 * @subpackage ObservantRecords2015
 * @since Observant Records 2015 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;
?>
<?php get_header(); ?>

	<?php if ( is_home() ): ?>
	<div class="col-md-12">
		<?php echo do_shortcode( "[metaslider id=36]" ); ?>
	</div>
	<?php endif; ?>

	<div class="col-md-8">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : // Start the Loop. ?>
				<?php the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php if ( is_home() === false): ?>
				<?php TemplateTags::paging_nav(); ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>

<?php get_sidebar( ); ?>
<?php get_footer();
