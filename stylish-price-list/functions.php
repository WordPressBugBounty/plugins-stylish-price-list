<?php

// Add dynamic version to css and js files when in beta mode
if ( ! function_exists( 'df_spl_get_file_version' ) ) {
	function df_spl_get_file_version( $file ) {
		$version = STYLISH_PRICE_LIST_VERSION;
		if ( file_exists( $file ) && STYLISH_PRICE_LIST_BETA === true ) {
			$version = $version . '.' . filemtime( $file );
		}
		return $version;
	}
}
if (!function_exists('spl_esc_output')) {
	function spl_esc_output( $output ) {
		return wp_kses_post( html_entity_decode( $output ) );
	}
}

if (!function_exists('spl_generate_schema_markup')) {
	function spl_generate_schema_markup( $spl_data_values, $jsonld_currency ) {
	
		// Populate the offers array
		foreach ($spl_data_values as $category) {
			$category_name = $category['name'];
			foreach (array_keys($category) as $key => $value) {
				$product = $category[$value];
				if ( !is_array( $product ) ) {
					continue;
				}
				$price = $product['service_price'];
				// strip the currency symbol
				$price = preg_replace( '/[^0-9.]/', '', $price );
				// check if $product['service_image'] is a valid URL, and if $price is not empty
				if ( !filter_var( $product['service_image'], FILTER_VALIDATE_URL ) || empty( $price ) ) {
					continue;
				}
				$schema_data = [
					"@context" => "https://schema.org/",
					"@type" => "Product",
					"name" => html_entity_decode( $product['service_name'] ),
					"category" => $category_name,
					"description" => $product['service_long_description'],
					"offers" => [
						"@type" => "Offer",
						"price" => $price,
						"priceCurrency" => $jsonld_currency,
						"availability" => "https://schema.org/InStock",
						"url" => get_permalink( $product['service_id'] )
					],
					"image" => [
						"@type" => "ImageObject",
						"url" => $product['service_image'],
						"image" => $product['service_image'],
						"name" => html_entity_decode( $product['service_name'] )
					]
				];
				// Encode the array to JSON
				$jsonLd = json_encode( $schema_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
				// Output the schema
				echo '<script id="schemaorg" type="application/ld+json">' . $jsonLd . '</script>';
			}
		}
	}
}

