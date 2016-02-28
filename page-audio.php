<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/9/14
 * Time: 5:54 PM
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\Audio;

$audio_id = get_query_var( 'audio_id' );

if ( !empty( $audio_id )) {
	$audio = Audio::find( $audio_id );

	if ( !empty( $audio) ) {
		header( 'Location: http://' . $audio->audio_file_server . $audio->audio_file_path . '/' . $audio->audio_file_name, 301 );
	}
}