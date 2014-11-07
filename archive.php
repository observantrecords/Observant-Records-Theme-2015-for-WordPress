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
		<header>
			<h2>
				<?php
				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', WP_TEXT_DOMAIN ), get_the_date() );

				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', WP_TEXT_DOMAIN ), get_the_date( _x( 'F Y', 'monthly archives date format', WP_TEXT_DOMAIN ) ) );

				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', WP_TEXT_DOMAIN ), get_the_date( _x( 'Y', 'yearly archives date format', WP_TEXT_DOMAIN ) ) );

				else :
					_e( 'Archives', WP_TEXT_DOMAIN );

				endif;
				?>
			</h2>
		</header><!-- .page-header -->

		<?php while ( have_posts() ) : // Start the Loop. ?>
			<?php the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<?php Musicwhore2015_Template_Tags::paging_nav(); ?>
	<?php endif; ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer();
