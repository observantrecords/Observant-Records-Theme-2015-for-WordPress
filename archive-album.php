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

use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Album;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artist;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Release;

$album_model = new Album();
$albums = $album_model->getAll( array( 'order_by' => 'album_release_date desc' ) );

$artist_model = new Artist();
$release_model = new Release();

$album_aliases = array();
if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		if ( get_post_status() == 'publish' ) :
			$album_aliases[] = get_post_meta( get_the_ID(), '_ob_album_alias', true );
		endif;
	endwhile;
endif;

?>
<?php get_header(); ?>

	<div class="col-md-12">

	<?php if ( have_posts() ) : ?>
		<?php the_post(); ?>
		<header>
			<h2>Releases</h2>
		</header>

		<?php if ( !empty( $albums ) ): ?>
			<?php $r = 1; ?>
			<?php foreach ($albums as $album): ?>
				<?php if (false !== ( array_search( $album->album_alias, $album_aliases ) )): ?>
					<?php $album->release = $release_model->get( $album->album_primary_release_id ); ?>
					<?php $album->artist = $artist_model->get( $album->album_artist_id ); ?>
					<?php $cover_url_base = TemplateTags::get_cdn_uri() . '/artists/' . $album->artist->artist_alias . '/albums/' . $album->album_alias . '/' . strtolower($album->release->release_catalog_num) . '/images'; ?>
					<?php if ($r % 4 == 0):?>
		<div class="row">
					<?php endif; ?>
			<div class="col-md-3">

				<p>
					<a href="/releases/<?php echo $album->album_alias; ?>">
						<img src="<?php echo $cover_url_base; ?>/cover_front_medium.jpg" width="200" alt="<?php echo $album->album_title; ?>" title="<?php echo $album->album_title; ?>" />
					</a>
				</p>

				<ul class="release-list-info">
					<li><strong><a href="releases/<?php echo $album->album_alias; ?>"><?php echo $album->album_title; ?></a></strong></li>
					<li><?php echo $album->artist->artist_display_name; ?></li>
				</ul>
			</div>
					<?php if ($r % 4 == 0):?>
		</div>
					<?php endif; ?>
					<?php $r++; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>

	<?php endif; ?>
	</div>

<?php get_footer();
