<?php
namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;
?>
<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="form-group">
		<label for="s">
			<span class="sr-only">Search for:</span>
		</label>
		<input type="search" class="form-control" placeholder="Search …" value="" name="s" title="Search for:" />
	</div>
	<input type="submit" class="search-submit btn btn-default" value="Search" />
</form>
