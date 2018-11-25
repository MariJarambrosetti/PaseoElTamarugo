<?php
	$translate = get_option( 'jt_travel_booking_translations' );
	include ( dirname( __FILE__ ) . '/../../options/variables.php');
	include ( dirname( __FILE__ ) . '/../../options/strings.php');
?>
<div class="destinations-search-widget-2"> 
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchDestinations">
		<p>
			<input type="text" name="s" placeholder="<?php echo __($search_destinations_text, 'jt-travel-booking'); ?>..."/>
		</p>
		
		<p>
			<label><?php echo __($number_of_days_text, 'jt-travel-booking'); ?></label>
			<input type="number" name="destination_days" min='1' />
		</p>
		
		<p>
			<label for="amount"><?php echo __($price_range_text, 'jt-travel-booking'); ?></label>
			<input type="text" name="destination_price" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
		</p>
		<div id="slider-range"></div>
		
		<input type="hidden" name="post_type" value="destinations_list" />
		<input type="submit" alt="Search" value="<?php echo __($search_text, 'jt-travel-booking'); ?>" />
	</form>
 </div>