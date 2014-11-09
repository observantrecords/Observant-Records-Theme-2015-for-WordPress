<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 5:07 PM
 *
 * @package WordPress
 * @subpackage Musicwhore2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Album;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artist;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Ecommerce;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Release;

$release = null;
$release_alias = get_post_meta( get_the_ID(), '_ob_release_alias', true );
$release_credits = get_post_meta( get_the_ID(), '_ob_release_credits', true );

if ( !empty( $release_alias ) ):
	$release_model = new Release();
	$release = $release_model->getBy( 'release_alias', $release_alias );

	if (!empty ($release ) ) {
		$album_model = new Album();
		$release->album = $album_model->get( $release->release_album_id );
		$artist_model = new Artist();
		$release->album->artist = $artist_model->get( $release->album->album_artist_id );
		$ecommerce_model = new Ecommerce();
		$release->ecommerce = $ecommerce_model->getManyBy( 'ecommerce_release_id', $release->release_id );
	}
endif;

?>
<div class="col-md-4">
<?php if ( !empty( $release ) ) : ?>
	<p>
		<a href="<?php echo TemplateTags::get_cdn_uri(); ?>/artists/<?php echo strtolower($release->album->artist->artist_alias); ?>/albums/<?php echo strtolower( $release->album->album_alias ); ?>/<?php echo strtolower( $release->release_catalog_num ); ?>/images/cover_front_large.jpg" rel="facebox">
			<img src="<?php echo TemplateTags::get_cdn_uri(); ?>/artists/<?php echo strtolower($release->album->artist->artist_alias); ?>/albums/<?php echo strtolower( $release->album->album_alias ); ?>/<?php echo strtolower( $release->release_catalog_num ); ?>/images/cover_front_medium.jpg" width="310" alt="[<?php echo $release->album->album_title; ?>]" title="[<?php echo $release->album->album_title; ?>]" />
		</a>
	</p>

	<p>
		<a href="<?php echo TemplateTags::get_cdn_uri(); ?>/artists/<?php echo strtolower($release->album->artist->artist_alias); ?>/albums/<?php echo strtolower( $release->album->album_alias ); ?>/<?php echo strtolower( $release->release_catalog_num ); ?>/images/cover_front_large.jpg" rel="facebox" class="smaller">View larger image</a>
	</p>

	<?php if ( count( $release->ecommerce ) > 0): ?>
	<h3>Buy</h3>

	<p>
	<?php foreach ( $release->ecommerce as $ecommerce): ?>
		<?php if ( $ecommerce->ecommerce_label == 'Observant Records Shop' ): ?>
		<a href="<?php echo $ecommerce->ecommerce_url; ?>" class="button"><img src="<?php echo TemplateTags::get_cdn_uri(); ?>/web/images/icons/checkout3-grey.gif" /> CD</a>
		<?php endif; ?>
		<?php if ($ecommerce->ecommerce_label == 'Bandcamp' ): ?>
			<a href="<?php echo $ecommerce->ecommerce_url ?>" class="button"><img src="<?php echo TemplateTags::get_cdn_uri(); ?>/web/images/icons/download-music-grey.gif" /> Digital</a>
		<?php endif; ?>
	<?php endforeach; ?>
	</p>

	<ul>
	<?php foreach ( $release->ecommerce as $ecommerce): ?>
		<?php if ( $ecommerce->ecommerce_label != 'Observant Records Shop' && $ecommerce->ecommerce_label != 'Bandcamp' ): ?>
		<li><a href="<?php echo $ecommerce_link->ecommerce_url; ?>"><?php echo $ecommerce->ecommerce_label; ?></a></li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	<?php if ( !empty( $release_credits ) ): ?>
	<h3>Credits</h3>

		<?php echo $release_credits; ?>
	<?php endif; ?>

<?php endif; ?>
</div>