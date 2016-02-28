<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 10/14/2014
 * Time: 11:05 AM
 *
 * @package WordPress
 * @subpackage Musicwhore 2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Track;

$lyrics = get_post_meta( get_the_ID(), '_ob_track_lyrics', true );
$track_alias = get_post_meta( get_the_ID(), '_ob_track_alias', true );

$track = null;
if ( !empty( $track_alias ) ):
	$track = Track::with('recording.audio')->where( 'track_alias', $track_alias )->get();
endif;


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header>
		<?php if ( is_single() || is_page() ): ?>
			<?php echo the_title('<h2 class="entry-title">', '</h2>'); ?>
		<?php else: ?>
			<?php echo the_title('<h3 class="entry-title"><a href="' . esc_url( get_permalink() )  . '" rel="bookmark">', '</a></h3>'); ?>
		<?php endif; ?>

		<div class="entry-meta">
			<ul class="list-inline">
				<?php if ( 'post' == get_post_type() ): ?>
					<?php TemplateTags::posted_on(); ?>
				<?php endif; ?>

				<?php edit_post_link( __( 'Edit', WP_TEXT_DOMAIN ), '<li><span class="glyphicon glyphicon-pencil"></span>', '</li>' ); ?>
			</ul>
		</div>

	</header>

	<?php if ( get_the_content() != '' ): ?>
		<?php if ( !empty( $track->recording->audio ) ): ?>

			<h3>Listen</h3>

			<audio id="track-<?php echo $track->track_recording_id; ?>" controls>
				<?php foreach ($track->recording->audio as $audio): ?>
					<source src="/audio/<?php echo $audio->audio_id; ?>/" type="<?php echo $audio->audio_file_type;?>" />
				<?php endforeach; ?>
			</audio>
		<?php endif; ?>

		<h3>About this track</h3>

		<?php the_content( __( 'Continue reading &raquo;', WP_TEXT_DOMAIN ) ); ?>
	<?php endif; ?>

	<?php if ( !empty( $lyrics )): ?>
		<h3>Lyrics</h3>

		<?php echo wpautop( $lyrics ); ?>
	<?php endif; ?>

</article>
