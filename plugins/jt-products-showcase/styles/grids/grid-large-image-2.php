<?php

	global $woocommerce;
	$cart_url = $woocommerce->cart->get_cart_url();
	
	// Get posts based on the widget's settings
	if ($product_category == 'all') {
		$args = array("post_type" => 'product', "posts_per_page" => $products_number - 1, "orderby" => $orderby, "order" => $order, "offset" => 1);
	} else {
		$args = array("post_type" => 'product', "posts_per_page" => $products_number - 1, "orderby" => $orderby, "order" => $order, "offset" => 1, 'tax_query' => array(
				array(
					'taxonomy'      => 'product_cat',
					'field' => 'term_id',
					'terms'         => $product_category,
					'operator'      => 'IN'
				)
			));
	}
?>
	<div class="uk-grid product-grid-large-image" data-uk-grid-match="{row: false}">
		<?php
			// Get the post that will be shown with image
			if ($product_category == 'all') {
				$prod1 = get_posts(array("post_type" => 'product', "posts_per_page" => 1, "orderby" => $orderby, "order" => $order));
			} else {
				$prod1 = get_posts(array("post_type" => 'product', "posts_per_page" => 1, "orderby" => $orderby, "order" => $order, 'tax_query' => array(
						array(
							'taxonomy'      => 'product_cat',
							'field' => 'term_id',
							'terms'         => $product_category,
							'operator'      => 'IN'
						)
					)));
			}
			$products_array = get_posts($args);

			
			// Show these posts in a grid
			foreach($prod1 as $prod) {
				$price = get_post_meta( $prod->ID, '_regular_price', true);
				$sale = get_post_meta( $prod->ID, '_sale_price', true);
				$sku = get_post_meta( $prod->ID, '_sku', true);
				
				echo '<div class="uk-width-6-10 large-img-col">
						<figure class="uk-overlay uk-overlay-hover">
							<a href="' . get_permalink( $prod->ID ) . '">
								<img class="uk-overlay-scale" src="' . wp_get_attachment_url( get_post_thumbnail_id($prod->ID), 'thumbnail'  ) . '" alt="">
							</a>';
							if ($sale != NULL) {
								echo '<p class="sale-icon">' . __('Sale') . '</p>';
							}
							echo '<figcaption class="uk-overlay-bottom uk-overlay-panel uk-overlay-background uk-ignore">
								<div class="uk-grid">
									<div class="uk-width-2-3">
										<p class="title"><a href="' . get_permalink( $prod->ID ) . '">' . $prod->post_title . '</a></p>';
										if ($show_sku == 'yes') {
											echo '<p class="product-sku">' . __('#') . $sku . '</p>';
										}
									echo '</div>
									<div class="uk-width-1-3">';
										if ($sale != NULL) {
											echo '<p class="price"><span class="regular">' . get_woocommerce_currency_symbol() . ' ' . $price . '</span><span class="sale">' . get_woocommerce_currency_symbol() . ' ' .$sale . '</span></p>';
										}
										else {
											echo '<p class="price">' . get_woocommerce_currency_symbol() . ' ' . $price . '</p>';
										}
									echo '</div>';
								echo '</div>';
								if ($add_to_cart_btn == 'yes') {
									echo '<a class="add-to-cart-btn" href="' . $cart_url . '?add-to-cart=' . $prod->ID . '"><i class="fa fa-shopping-cart"></i> Add to Cart</a>';
								}
				
								echo '</figcaption>';
								if ($show_read_more == 'yes') {
									echo '<p class="product-btn"><a href="'  . get_permalink( $prod->ID ) . '"><i class="fa fa-search"></i></a></p>';
								}
							echo '</figure>
					</div>';
			} 


		echo '<div class="uk-width-4-10">
				<div class="uk-grid small-images-col">';
			// Show these posts in a grid
			foreach($products_array as $product) {
				$price = get_post_meta( $product->ID, '_regular_price', true);
				$sale = get_post_meta( $product->ID, '_sale_price', true);
				$sku = get_post_meta( $product->ID, '_sku', true);
				
				echo '<div class="uk-width-1-1">
						<figure class="uk-overlay uk-overlay-hover">
							<a href="' . get_permalink( $product->ID ) . '">
								<img class="uk-overlay-scale" src="' . wp_get_attachment_url( get_post_thumbnail_id($product->ID), 'thumbnail'  ) . '" alt="">
							</a>';
							if ($sale != NULL) {
								echo '<p class="sale-icon">' . __('Sale') . '</p>';
							}
							echo '<figcaption class="uk-overlay-bottom uk-overlay-panel uk-overlay-background uk-ignore">
								<div class="uk-grid">
									<div class="uk-width-2-3">
										<p class="title"><a href="' . get_permalink( $product->ID ) . '">' . $product->post_title . '</a></p>';
										if ($show_sku == 'yes') {
											echo '<p class="product-sku">' . __('#') . $sku . '</p>';
										}
									echo '</div>
									<div class="uk-width-1-3">';
										if ($sale != NULL) {
											echo '<p class="price"><span class="regular">' . get_woocommerce_currency_symbol() . ' ' . $price . '</span><span class="sale">' . get_woocommerce_currency_symbol() . ' ' .$sale . '</span></p>';
										}
										else {
											echo '<p class="price">' . get_woocommerce_currency_symbol() . ' ' . $price . '</p>';
										}
									echo '</div>';
								echo '</div>';
				
								if ($add_to_cart_btn == 'yes') {
									echo '<a class="add-to-cart-btn" href="' . $cart_url . '?add-to-cart=' . $product->ID . '"><i class="fa fa-shopping-cart"></i> Add to Cart</a>';
								}
				
								echo '</figcaption>';
								if ($show_read_more == 'yes') {
									echo '<p class="product-btn"><a href="'  . get_permalink( $product->ID ) . '"><i class="fa fa-search"></i></a></p>';
								}
							echo '</figure>
					</div>';
			} 

			echo '</div>
				</div>';

		?>
	</div>
