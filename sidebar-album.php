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

$ecommerce_buy_now = null;
$ecommerce_also_available = [];

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

		if ( count( $release->ecommerce ) > 0):
			foreach ( $release->ecommerce as $ecommerce):
				if ( $ecommerce->ecommerce_label == 'Bandcamp' ):
					$ecommerce_buy_now = $ecommerce;
				else:
					$ecommerce_also_available[] = $ecommerce;
				endif;
			endforeach;
		endif;
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
		<a href="<?php echo TemplateTags::get_cdn_uri(); ?>/artists/<?php echo strtolower($release->album->artist->artist_alias); ?>/albums/<?php echo strtolower( $release->album->album_alias ); ?>/<?php echo strtolower( $release->release_catalog_num ); ?>/images/cover_front_large.jpg" rel="facebox" class="small">View larger image</a>
	</p>

	<ul class="list-unstyled">
		<?php if ( !empty( $release->release_label ) ): ?>
		<li>Label: <strong><?php echo $release->release_label; ?></li></strong>
		<?php endif; ?>
		<?php if ( !empty( $release->release_release_date ) ): ?>
		<li>Release date: <strong><?php echo date('F d, Y', strtotime( $release->release_release_date ) ); ?></strong></li>
		<?php endif; ?>
	</ul>

	<?php if ( !empty( $ecommerce_buy_now ) ): ?>
	<ul class="list-inline">
		<li><a href="<?php echo $ecommerce_buy_now->ecommerce_url; ?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-shopping-cart"></span> Buy now</a></li>
	</ul>
	<?php endif; ?>

	<?php if ( count($ecommerce_also_available) > 0): ?>
	<h4>Also available from:</h4>

	<ul>
		<?php foreach ( $ecommerce_also_available as $ecommerce ): ?>
			<?php if ( $ecommerce->ecommerce_label != 'Observant Records Shop' && $ecommerce->ecommerce_label != 'Bandcamp' ): ?>
		<li><a href="<?php echo $ecommerce->ecommerce_url; ?>"><?php echo $ecommerce->ecommerce_label; ?></a></li>
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