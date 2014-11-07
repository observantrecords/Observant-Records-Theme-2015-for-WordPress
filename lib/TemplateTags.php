<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 9:28 PM
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

class TemplateTags {
	public static function get_cdn_uri() {
		return OBSERVANTRECORDS_CDN_BASE_URI;
	}

	public static function paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$pagination_args = array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'musicwhore2014' ),
			'next_text' => __( 'Next &rarr;', 'musicwhore2014' ),
			'type' => 'list',
			'list_class' => 'pagination',
		);
		$links = ( function_exists( 'bootstrap_paginate_links' ) === true ) ? bootstrap_paginate_links( $pagination_args ) : paginate_links( $pagination_args );

		if ( $links ) :

			?>
			<nav role="navigation">
				<h1 class="sr-only"><?php _e( 'Posts navigation', 'musicwhore2014' ); ?></h1>
				<?php echo $links; ?>
			</nav><!-- .navigation -->
		<?php
		endif;
	}

	public static function post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav role="navigation">
			<h4 class="sr-only"><?php _e( 'Post navigation', 'musicwhore2014' ); ?></h4>
			<ul class="pager">
				<?php if ( is_attachment() ) : ?>
					<li><?php previous_post_link( '%link', __( 'Published In %title', 'musicwhore2015' ) ); ?></li>
				<?php else : ?>
					<li><?php previous_post_link( '%link', __( '<span title="Previous Post: %title">Previous</span>', 'musicwhore2015' ) ); ?></li>
					<li><?php next_post_link( '%link', __( '<span title="Next Post: %title">Next</span>', 'musicwhore2015' ) ); ?></li>
				<?php endif; ?>
			</ul>
		</nav><!-- .navigation -->
	<?php
	}

	public static function posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			$sticky = translate( 'Sticky', 'musicwhore2015' );
			echo <<< POSTED_ON
<li><span class="glyphicon glyphicon-star"></span> $sticky</li>
POSTED_ON;
		}

		// Set up and print post meta information.
		printf( '
<li>
	<span class="glyphicon glyphicon-calendar"></span>
	<a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a>
</li>
<li>
	<span class="glyphicon glyphicon-user"></span>
	<a href="%4$s" rel="author">%5$s</a>
</li>',
			esc_url( get_permalink() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}

}