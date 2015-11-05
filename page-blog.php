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

global $post;
$blog_posts = get_posts();
?>
<?php get_header(); ?>

	<div class="col-md-8">

	<?php if ( ( $post_count = count( $blog_posts ) ) > 0 ) : ?>
		<header>
			<h2>Blog</h2>
		</header><!-- .page-header -->

		<?php foreach ( $blog_posts as $p => $blog_post ) : ?>
			<?php $post = $blog_post; ?>
			<?php setup_postdata( $blog_post ); ?>
			<?php get_template_part( 'content', 'blog-index' ); ?>
		<?php endforeach; ?>
		<?php TemplateTags::paging_nav( $blog_posts ); ?>
	<?php endif; ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer();
