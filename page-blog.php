<?php
/*
Template Name: Blog Archive
 */

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

$blog_query = new \WP_Query( [ 'post_type' => 'post' ] );

add_action('loop_start', array( 'ObservantRecords\WordPress\Themes\ObservantRecords2015\Setup', 'jetpack_remove_share'));
?>
<?php get_header(); ?>

	<div class="col-md-8">

		<header>
			<h2>Blog</h2>
		</header><!-- .page-header -->

	<?php while ( $blog_query->have_posts() ): ?>
		<?php $blog_query->the_post(); ?>
		<?php get_template_part( 'content', 'blog-index' ); ?>
	<?php endwhile; ?>
	<?php TemplateTags::paging_nav(); ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer();
