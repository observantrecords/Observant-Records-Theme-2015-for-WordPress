<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 11/5/2015
 * Time: 2:50 PM
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;


class MailChimpShortcode
{

	public function __construct()
	{

	}

	public static function init()
	{

		add_shortcode('mailchimp', array(__CLASS__, 'displayShortcode'));

	}

	public static function displayShortcode($attributes)
	{
		$input = shortcode_atts([
			'group' => 'all',
			'size' => null,
		], $attributes);

		return ($input['size'] == 'short') ? self::getShortForm($input['group']) : self::getFullForm($input['group']);
	}

	private static function getFullForm($group = 'all')
	{
		$group_output = self::getGroupInputElement($group);
		$output = <<< OUTPUT
<!-- Begin MailChimp Signup Form -->
<form action="//observantrecords.us11.list-manage.com/subscribe/post?u=a04e90fa99b1b93d418f4ae9d&amp;id=8a11bbe4d2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
	<div class="form-group">
		<label for="mce-EMAIL">Email Address (required)</label>
		<input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL" required="true">
	</div>
	<div class="form-group">
		<label for="mce-FNAME">First Name</label>
		<input type="text" value="" name="FNAME" class="form-control" id="mce-FNAME">
	</div>
	<div class="form-group">
		<label for="mce-LNAME">Last Name</label>
		<input type="text" value="" name="LNAME" class="form-control" id="mce-LNAME">
	</div>

	$group_output

	<p>
		Please format my e-mail as ...
	</p>

	<div class="radio">
		<label for="mce-EMAILTYPE-0">
			<input type="radio" value="html" name="EMAILTYPE" id="mce-EMAILTYPE-0" checked>
			HTML
		</label>
	</div>
	<div class="radio">
		<label for="mce-EMAILTYPE-1">
			<input type="radio" value="text" name="EMAILTYPE" id="mce-EMAILTYPE-1">
			Text
		</label>
	</div>

	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>
	<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_a04e90fa99b1b93d418f4ae9d_8a11bbe4d2" tabindex="-1" value=""></div>

    <div class="form-group">
    	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary btn-lg">
    </div>
</form>

<!--End mc_embed_signup-->
OUTPUT;
		return $output;
	}

	private static function getShortForm($group = 'all')
	{
		$group_output = self::getGroupInputElement($group, 'short');
		$output = <<< OUTPUT
<!-- Begin MailChimp Signup Form -->
<form action="//observantrecords.us11.list-manage.com/subscribe/post?u=a04e90fa99b1b93d418f4ae9d&amp;id=8a11bbe4d2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
	<div class="form-group">
		<label for="mce-EMAIL">Email Address</label>
		<input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL" required="true">
	</div>

	$group_output

	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>
	<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_a04e90fa99b1b93d418f4ae9d_8a11bbe4d2" tabindex="-1" value=""></div>

    <div class="form-group">
    	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
    </div>
</form>

<!--End mc_embed_signup-->
OUTPUT;
		return $output;
	}

	private static function getGroupInputElement($group = 'all', $size = null)
	{
		if ($group != 'all') {
			switch ($group) {
				case 'empty_ensemble':
					$output = <<< EMPTY_ENSEMBLE
	<input type="hidden" value="1" name="group[7993][2]" id="mce-group[7993]-7993-1" />
EMPTY_ENSEMBLE;

					break;
				case 'penzias_and_wilson':
					$output = <<< PENZIAS_AND_WILSON
	<input type="hidden" value="1" name="group[7993][4]" id="mce-group[7993]-7993-2" />
PENZIAS_AND_WILSON;
					break;
				default: // Always Eponymous 4
					$output = <<< EPONYMOUS_4
	<input type="hidden" value="1" name="group[7993][1]" id="mce-group[7993]-7993-0" />
EPONYMOUS_4;

			}

		} else {
			if ($size == 'short') {
				$output = <<< SHORT
	<input type="hidden" value="1" name="group[7993][1]" id="mce-group[7993]-7993-0" />
	<input type="hidden" value="1" name="group[7993][2]" id="mce-group[7993]-7993-1" />
	<input type="hidden" value="1" name="group[7993][4]" id="mce-group[7993]-7993-2" />
SHORT;
			} else {
				$output = <<< FULL
	<p>
		I want to get news about ...
	</p>

	<div class="checkbox">
		<label for="mce-group[7993]-7993-0">
			<input type="checkbox" value="1" name="group[7993][1]" id="mce-group[7993]-7993-0" checked />
			Eponymous 4
		</label>
	</div>
	<div class="checkbox">
		<label for="mce-group[7993]-7993-1">
			<input type="checkbox" value="2" name="group[7993][2]" id="mce-group[7993]-7993-1" checked />
			Empty Ensemble
		</label>
	</div>
	<div class="checkbox">
		<label for="mce-group[7993]-7993-2">
			<input type="checkbox" value="4" name="group[7993][4]" id="mce-group[7993]-7993-2" checked />
			Penzias and Wilson
		</label>
	</div>
FULL;
			}
		}

		return $output;
	}


}