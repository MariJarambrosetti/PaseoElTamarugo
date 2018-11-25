<?php
include ( dirname( __FILE__ ) . '/../options/variables.php');
	
$colors = get_option('jt_travel_booking_colors');
if (!empty ($colors[travel_booking_basic_color])) {
	$basic_color = $colors[travel_booking_basic_color];
}
else {
	$basic_color = '#ff8989';
}
list($r, $g, $b) = sscanf($basic_color, "#%02x%02x%02x");

$travel_colors = "
	.destinations-default-2 .price span {
		background: {$basic_color};
	}
	.destinations-default-2 .destination-more-info a:hover {
		color: {$basic_color};
	}
	.destinations-3-cols-colored .destination-bottom-info {
		background: rgba({$r},{$g},{$b}, 0.9);
	}
	.destinations-3-cols-colored .destination-more-info a:hover {
		color: {$basic_color};
	}
	.destinations-grid-4-cols-2 .destination-price {
		background: {$basic_color};
	}
	.destinations-grid-overlay-text .destination-more-info a {
		background: {$basic_color};
		border: 1px solid {$basic_color};
	}
	.destinations-grid-overlay-text .destination-more-info a:hover {
		color: {$basic_color};
		border: 1px solid {$basic_color};
	}
	.destinations-slideset-4-cols span.price-box {
		background: {$basic_color};
	}
	.jt-travel-booking .destination-price-box {
		background: rgba({$r},{$g},{$b}, 0.8);
	}
	.jt-travel-booking .uk-tab .uk-active a {
		background: {$basic_color} !important;
	}
	.jt-travel-booking .book-destination-box .col-md-3 {
		background: {$basic_color};
	}
	.jt-travel-booking .more-destinations-section h4 span:before,
	.jt-travel-booking .more-destinations-section h4 span:after {
		background: {$basic_color};
	}
	.jt-travel-booking-2 .entry-header span i {
		color: {$basic_color};
	}
	.jt-travel-booking-2 .destination-price-box {
		background: {$basic_color};
	}
	.jt-travel-booking-2 .uk-tab li.uk-active a:after {
		background: {$basic_color};
	}
	.jt-travel-booking-2 .book-destination-box .col-md-3 {
		background: {$basic_color};
	}
	.jt-travel-booking-2 .more-destinations-section h4 span:before,
	.jt-travel-booking-2 .more-destinations-section h4 span:after {
		background: {$basic_color};
	}
	.jt-travel-booking-3 .price-section .price {
		background: rgba({$r},{$g},{$b}, 0.8);
	}
	.jt-travel-booking-3 .info-tabs .uk-active a, .jt-travel-booking-3 .info-tabs a:hover {
		color: {$basic_color};
	}
	.jt-travel-booking-3 .more-destinations .more-destinations-title span, .jt-travel-booking-3 .agency-info h3 span {
		background: {$basic_color};
	}
	.jt-travel-booking-3 .more-destinations .more-destinations-title span:after, .jt-travel-booking-3 .agency-info h3 span:after {
		background: {$basic_color};
	}
	.jt-travel-booking-3 .book-destination-box .col-md-3 {
		background: {$basic_color};
	}
	.destinations-category-2 .destination-basic-info .destination-price {
		background: {$basic_color};
	}
	.destination-category-title:after {
		background: {$basic_color};
	}
	.single-destination-default .destination-title a {
		color: {$basic_color};
	}
	.single-destination-default .destination-price {
		background: {$basic_color};
	}
	.jt-travel-booking-4 .destination-top-section i {
		color: {$basic_color};
	}
	.jt-travel-booking-4 .destination-top-section .destination-price {
		background: {$basic_color};
	}
	.jt-travel-booking-4 .destination-info-section .info-tabs li.uk-active a {
		color: {$basic_color};
		border-bottom: 1px solid {$basic_color};
	}
	.jt-travel-booking-4 .book-destination-box .book-now-btn {
		background: {$basic_color};
	}
	.agency-info h3 span {
		border-bottom: 1px solid {$basic_color};
	}
";

wp_add_inline_style( 'jt-travel-booking', $travel_colors );
?>