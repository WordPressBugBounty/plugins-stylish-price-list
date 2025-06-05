jQuery( '.add_to_webpage' ).click( function({currentTarget}) {
	event.preventDefault(); 
	jQuery('.add_to_webpage, .font_settitng, .advance_setting').not(currentTarget).removeClass('active');
	jQuery( '.show_hide_shortcode' ).toggle(function() {
		jQuery(currentTarget).toggleClass('active');
	}); 
	jQuery( '.font_setting_container' ).hide();
	jQuery( '.more_setting' ).hide();
} );

jQuery( '.font_settitng' ).click( function({currentTarget}) {
	event.preventDefault(); 
	jQuery('.add_to_webpage, .font_settitng, .advance_setting').not(currentTarget).removeClass('active');
	jQuery( '.font_setting_container' ).toggle(function() {
		jQuery(currentTarget).toggleClass('active');
	});
	jQuery( '.show_hide_shortcode' ).hide();
	jQuery( '.more_setting' ).hide();
} );

jQuery( '.advance_setting' ).click( function({currentTarget}) {
	event.preventDefault(); 
	jQuery('.add_to_webpage, .font_settitng, .advance_setting').not(currentTarget).removeClass('active');
	jQuery( '.more_setting' ).toggle(function() {
		jQuery(currentTarget).toggleClass('active');
	});
	jQuery( '.font_setting_container' ).hide();
	jQuery( '.show_hide_shortcode' ).hide();
} );

jQuery( '.preview_list' ).click( function() {
	jQuery( '.backup_content' ).hide(), jQuery( '.restore_content' ).hide();
} );

jQuery( '.backup' ).click( function({target}) {
	const {action, listId, listName, nonce} = target.dataset;
	// quit if any of the required fields are empty
	if ( ! action || ! listId || ! listName || ! nonce ) {
		return;
	}
	jQuery( '.restore_content' ).hide();
	fetch(action, {
		"headers": {
		  "cache-control": "no-cache",
		  "content-type": "application/x-www-form-urlencoded",
		  "pragma": "no-cache",
		  "upgrade-insecure-requests": "1"
		},
		"referrer": "http://freshsite.test/wp-admin/admin.php?page=spl-tabs&action=edit&id=" + listId,
		"referrerPolicy": "strict-origin-when-cross-origin",
		"body": new URLSearchParams({
			"_wpnonce": nonce,
			"_wp_http_referer": window.location.href,
			"list_id": listId,
			"backup": listName
		}),
		"method": "POST",
		"mode": "cors",
		"credentials": "include"
	  }).then(response => response.blob())
		.then(blob => {
			const link = document.createElement('a');
			const url = URL.createObjectURL(blob);
			link.href = url;
			link.download = listName + '.csv';
			document.body.appendChild(link);
			link.click();
			document.body.removeChild(link);
		})
		.catch(error => {
			console.error('Error fetching and downloading the file:', error);
		});
} );

jQuery( '.restore' ).click( function() {
	jQuery( '.backup_content' ).hide(), jQuery( '.restore_content' ).toggle();
} );

const settingsWithDependency = jQuery('[data-dependency-settings]');

settingsWithDependency.each(function (index, setting) {
	const checkboxes = setting.getAttribute('data-dependency-settings').split(',');
	checkboxes.forEach(function (checkbox) {
		jQuery(`[name='${checkbox}']`).on('change', function () {
			if (jQuery(`[name='${checkbox}']:checked`).val() === '1') {
				jQuery(setting).removeClass('d-none');
			} else {
				jQuery(setting).addClass('d-none');
			}
		});
	});
});

// set default font size

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'with_tab' == this.value &&
		(
		// Title
			jQuery( 'select[name="title_font_size"]' ).val( '36px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#65b5a8' ).trigger('change'),
			jQuery( 'select[name="list_name_font"]' ).val( 'Playfair-Display' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '700' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Playfair-Display' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#65b5a8' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '16px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#aaaaaa' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#000' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#000' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#65b5a8' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '700' ).attr( 'selected', ! 0 ),
			jQuery( jQuery( '.color-picker' )[ 4 ] ).val( '#65b5a8' ).trigger( 'change' ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( jQuery( '.color-picker' )[ 5 ] ).val( '#000' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )

		);
	},
);

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'without_tab' == this.value && (
		// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#e9b200' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '25px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#e9b200' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#bcb3ab' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#020202' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#e9b200' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#e9b200' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '17px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#bcb3ab' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
	},
);

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'without_tab_single_column' == this.value && (
		// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#e9b200' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '25px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#e9b200' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#bcb3ab' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#020202' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#e9b200' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#e9b200' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '17px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#bcb3ab' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
	},
);

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'style_3' == this.value && (
		// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#bc250d' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Playfair-Display' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '300' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Playfair-Display' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '900' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#bc250d' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#aaaaaa' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '17px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#020202' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#020202' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#bc250d' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '17px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Gothic-A1' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#000' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
	},
);

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		if ( [ 'style_4', 'style_10' ].includes( this.value ) ) {
		// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#879401' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '700' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '22px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '700' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#879401' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '12px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#7a7a7a' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '16px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#494949' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#879401' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '700' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#879401' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '500' ).attr( 'selected', ! 0 ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#282624' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '' ).attr( 'selected', ! 0 )
		};
		if ( this.value == 'style_4' ) {
			jQuery( 'select[name="service_description_font_size"]' ).val( '12px' ).attr( 'selected', ! 0 );
			jQuery( 'select[name="style4_divider_style"]' ).val( '1' ).attr( 'selected', ! 0 );
		}
	},
);

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'style_5' == this.value && (
		// Title
			jQuery( 'select[name="title_font_size"]' ).val( '30px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '13px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#545454' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#aaaaaa' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#549600' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#549600' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '700' ).attr( 'selected', ! 0 ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#549600' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '' ).attr( 'selected', ! 0 )
		);
	},
);

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'style_6' == this.value && (
		// Default column settings
			jQuery( '[name="select_column"]' ).val( 'Two' ),

			// Title
			jQuery( 'select[name="title_font_size"]' ).val( '50px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#353535' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Poppins' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '16px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#353535' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '17px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Roboto' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#457a01' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Asap' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#457a01' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '17px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Open-Sans' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#000' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
	},
);
jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'style_7' == this.value && (
			// Default column settings
			jQuery( '[name="select_column"]' ).val( 'Two' ),

			// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#bb9d9e' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#4d243d' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#7c7c7c' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '300' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '18px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#4d243d' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#4d243d' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '15px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#7c7c7c' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
		'style_8' == this.value && (
		// Default column settings
			jQuery( '[name="select_column"]' ).val( 'One' ),

			// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '16px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#e5989b' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#7c7c7c' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '300' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#e5989b' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#e5989b' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			//   jQuery('select[name="title_font-weight"]').val("Raleway").attr("selected",!0),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#7c7c7c' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
	},
);

jQuery( '.sel1' ).on(
	'load-demo-settings',
	function() {
		'style_table_1' == this.value && (
			// Default column settings
			jQuery( '[name="select_column"]' ).val( 'Two' ),

			// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#bb9d9e' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#ffffff' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '15px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#7c7c7c' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '300' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#4d243d' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#4d243d' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#000000' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
		'style_table_2' == this.value && (
		// Default column settings
			jQuery( '[name="select_column"]' ).val( 'One' ),

			// Title
			jQuery( 'select[name="title_font_size"]' ).val( '35px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color_top"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="list_name_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Category Tab
			jQuery( 'select[name="tab_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="title_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="title_color"]' ).val( '#ffffff' ).trigger( 'change' ),

			// Description
			jQuery( 'select[name="service_description_font_size"]' ).val( '14px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_description_color"]' ).val( '#7c7c7c' ).trigger( 'change' ),
			jQuery( 'select[name="description_font-weight"]' ).val( '300' ).attr( 'selected', ! 0 ),

			// Item Name
			jQuery( 'select[name="service_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="service_color"]' ).val( '#545454' ).trigger( 'change' ),
			jQuery( 'select[name="desc_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="hover_color"]' ).val( '#e5989b' ).trigger( 'change' ),
			jQuery( 'select[name="service_font-weight"]' ).val( '600' ).attr( 'selected', ! 0 ),

			// Price
			jQuery( 'select[name="price_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="price_color"]' ).val( '#e5989b' ).trigger( 'change' ),
			jQuery( 'select[name="service_price_font_size"]' ).val( '20px' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="service_price_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 ),

			// Category Description
			jQuery( 'select[name="tab_description_font_size"]' ).val( '' ).attr( 'selected', ! 0 ),
			jQuery( 'select[name="tab_description_font"]' ).val( 'Montserrat' ).attr( 'selected', ! 0 ),
			jQuery( 'input[name="tab_description_color"]' ).val( '#000000' ).trigger( 'change' ),
			jQuery( 'select[name="tab_description_font-weight"]' ).val( '400' ).attr( 'selected', ! 0 )
		);
	},
);



// TODO: add default settings for style 8

const change_lang = jQuery( '.change_lang' ).val();
const save_lang = jQuery( '.save_lang' ).val();
if ( change_lang !== '' ) {
	if ( change_lang == 'EN' ) {
		var cat_name = 'Category Name ';
		var cat_des = 'Category Description ';
		var service_name = 'Item Name ';
		var service_button = 'Button Text ';
		var service_button_url = 'Button URL ';
		var service_regular_price = 'Regular Price ';
		var service_price = 'Price ';
		var service_des = 'Description ';
		var service_image = 'Product/Service Image ';
		var service_long_description = 'Long Description ';
	}

	if ( change_lang == 'SP' ) {
		var cat_name = 'nombre de la categor�a';
		var cat_des = 'Descripci�n de categor�a ';
		var service_name = 'Nombre del Servicio';
		var service_button = 'Botón de servicio';
		var service_button_url = 'URL del botón de servicio';
		var service_regular_price = 'Precio regular ';
		var service_price = 'Precio del servicio ';
		var service_des = 'Descripci�n del servicio ';
		var service_image = 'Imagen de servicio ';
		var service_long_description = 'Long Description';
	}

	if ( change_lang == 'FR' ) {
		var cat_name = 'Nom de cat�gorie';
		var cat_des = 'description de la cat�gorie ';
		var service_name = 'Nom du service';
		var service_button = 'Bouton de service';
		var service_button_url = 'URL du bouton de service';
		var service_regular_price = 'Prix régulier ';
		var service_price = 'Prix du service ';
		var service_des = 'Description du service ';
		var service_image = 'Image de service ';
		var service_long_description = 'Long Description';
	}

	if ( change_lang == 'DE' ) {
		var cat_name = 'categorie naam';
		var cat_des = 'categorie beschrijving ';
		var service_name = 'Servicenaam';
		var service_button = 'Serviceknop';
		var service_button_url = 'Service Button URL ';
		var service_regular_price = 'Normale prijs ';
		var service_price = 'Serviceprijs ';
		var service_price = 'Serviceprijs ';
		var service_des = 'Servicebeschrijving ';
		var service_image = 'Service afbeelding ';
		var service_long_description = 'Long Description';
	}
} else {
	if ( jQuery.trim( save_lang ) == 'EN' ) {
		var cat_name = 'Category Name ';
		var cat_des = 'Category Description ';
		var service_name = 'Item Name ';
		var service_button = 'Button Text ';
		var service_button_url = 'Button URL ';
		var service_regular_price = 'Regular Price ';
		var service_price = 'Price ';
		var service_des = 'Description ';
		var service_image = 'Product/Service Image ';
		var service_long_description = 'Long Description ';
	}

	if ( jQuery.trim( save_lang ) == 'SP' ) {
		var cat_name = 'nombre de la categor�a';
		var cat_des = 'Descripci�n de categor�a ';
		var service_name = 'Nombre del Servicio';
		var service_button = 'Botón de servicio';
		var service_button_url = 'URL del botón de servicio';
		var service_regular_price = 'Precio regular';
		var service_price = 'Precio del servicio';
		var service_des = 'Descripci�n del servicio ';
		var service_image = 'Imagen de servicio';
		var service_long_description = 'Long Description';
	}

	if ( jQuery.trim( save_lang ) == 'FR' ) {
		var cat_name = 'Nom de cat�gorie';
		var cat_des = 'description de la cat�gorie ';
		var service_name = 'Nom du service';
		var service_button = 'Bouton de service';
		var service_button_url = 'URL du bouton de service';
		var service_regular_price = 'Prix régulier';
		var service_price = 'Prix du service';
		var service_des = 'Description du service ';
		var service_image = 'Image de service';
		var service_long_description = 'Long Description';
	}

	if ( jQuery.trim( save_lang ) == 'DE' ) {
		var cat_name = 'categorie naam';
		var cat_des = 'categorie beschrijving ';
		var service_name = 'Servicenaam';
		var service_button = 'Serviceknop';
		var service_button_url = 'Service Button URL';
		var service_regular_price = 'Normale prijs';
		var service_price = 'Serviceprijs';
		var service_des = 'Servicebeschrijving ';
		var service_image = 'Service afbeelding';
		var service_long_description = 'Long Description';
	}
}

function historyGoBack(btn) {
	event.preventDefault();
	if (window.history.length <= 1 || document.referrer === window.location.href || document.referrer === '') {
		window.location.href = window.location.origin + '/wp-admin/';
		return;
	} else {
		window.history.back();
	}
}

function get_category_id( wrapper_id ) {
	const cat_input = jQuery( wrapper_id ).find( '.category_name' );
	if ( cat_input.length > 0 ) {
		const _name = cat_input.last().attr( 'name' );
		return get_cat_id_from_name( _name );
	}
	return 0;
}

function get_category_count( wrapper_id ) {
	const cat_input = jQuery( wrapper_id ).find( '.category_name' ); if ( cat_input.length > 0 ) {
		return cat_input.length;
	}
	return 0;
}
function get_category_max( wrapper_id ) {
	const cat_input_ids = jQuery( wrapper_id ).find( '.category_name' ).map( ( i, e ) => parseInt( e.getAttribute( 'id' ).split( '_' )[ 1 ] ) ).get();
	const cat_input_id_max = Math.max( ...cat_input_ids );
	return cat_input_id_max;
}

function get_cat_id_from_name( name_string ) {
	const match = name_string.match( /category\[(.*?)\]\[name\]/ );
	if ( null == match ) {
		return null;
	}
	return match[ 1 ];
}

function get_service_id_for_add_service_link( add_service_ele ) {
	const category_row = get_category_row_from_add_remove_service_link( add_service_ele ); const service_name_input = category_row.find( '.service .service_name' ); if ( service_name_input.length > 0 ) {
		const _name = service_name_input.last().attr( 'name' ); return get_service_id_from_name( _name );
	}
	return null;
}

function get_service_id_from_name( name_string ) {
	const match = name_string.match( /category\[(\d+)\]\[(\d+)\]\[service_name\]/ ); if ( null == match ) {
		return null;
	}
	return match[ 2 ];
}

function generate_category_data( cat_id ) {
	const result = {
		name: 'category[' + cat_id + '][name]',
		id: 'category_' + cat_id + '_name',
		label: cat_name
	}; return result;
}

function update_category_row_html( cat_wrapper, cat_id, service_id ) {
	const _cat_data = generate_category_data( cat_id );
	const cat_name_row = cat_wrapper.find( '.category-name-row:first' );
	const _label = cat_name_row.find( 'label' );
	_label.attr( 'for', _cat_data.id );
	_label.html( _cat_data.label );
	const cat_des_row = cat_wrapper.find( '.category-description-row:first' );
	const _label1 = cat_des_row.find( 'label' );
	_label1.attr( 'for', 'category_' + cat_id + '_description' );
	_label1.html( cat_des );
	const _input = cat_name_row.find( 'input.category_name' );
	_input.attr( 'name', _cat_data.name );
	_input.attr( 'id', _cat_data.id );
	const _textarea = cat_des_row.find( 'textarea.category_description' );
	_textarea.attr( 'name', 'category[' + cat_id + '][description]' );
	_textarea.attr( 'id', 'category_' + cat_id + '_description' );
	const _color = cat_wrapper.find( '.category-background-color-row' );
	_color.attr( 'name', 'category[' + cat_id + '][background_color]' );
	_color.attr( 'id', 'category_' + cat_id + '_color' );

	const _price = cat_wrapper.find( '.category-price-row' );
	_price.attr( 'name', 'category[' + cat_id + '][price]' );
	_price.attr( 'id', 'category_' + cat_id + '_price' );

	const _cat_action_text = cat_wrapper.find( '.category_action_text' );
	_cat_action_text.attr( 'name', 'category[' + cat_id + '][action_text]' );
	_cat_action_text.attr( 'id', 'category_' + cat_id + '_action_text' );

	const _cat_action_link = cat_wrapper.find( '.category_action_link' );
	_cat_action_link.attr( 'name', 'category[' + cat_id + '][action_link]' );
	_cat_action_link.attr( 'id', 'category_' + cat_id + '_action_link' );

	update_service_rows_html( cat_wrapper.find( '.service:last' ), cat_id, service_id );
	return cat_wrapper.find( '.category-row' ).html();
}

function update_service_rows_html( service_el, cat_id, service_id ) {

	const input_wrapper_el = service_el.find( '.service-price-length' );

	input_wrapper_el.each(function (){
		const input_el = jQuery(this).find('[name]');
		const label_el = jQuery(this).find('label');

		input_el.each(function (){
			if(jQuery(this).prop('name')){
				const parsed_input_name = jQuery(this).prop('name').split(/\[|\]/);
				const input_name = parsed_input_name[parsed_input_name.length - 2];
				const id = `category_${cat_id}_${service_id}_${input_name}`;
				const name = `category[${cat_id}][${service_id}][${input_name}]`;
	
				label_el.prop('for', id);
				jQuery(this).prop('id', id);
				jQuery(this).prop('name', name);
			}
		});
	});
}

function get_cat_id_service_id_from_add_service_link( add_service_ele ) {
	const category_row = get_category_row_from_add_remove_service_link( add_service_ele ); const _cat_id = get_category_id( category_row ); const _service_id = get_service_id_for_add_service_link( add_service_ele ); return { service_id: _service_id, cat_id: _cat_id };
}

function get_category_row_from_add_remove_service_link( add_service_ele ) {
	const category_row = add_service_ele.parents(".category-row");
	return category_row;
}

function get_category_row_from_copy_icon( copy_icon ) {
	const category_row = copy_icon.parents(".category-row");
	return category_row;
}

function get_service_rows_from_copy_icon( copy_icon ) {
	const service_row = copy_icon.parents('.service');
	return service_row;
}

function get_service_rows_from_add_remove_service_link( remove_service_ele ) {
	const service_row = remove_service_ele.parents('.service');
	return service_row;
}

const setupSurveyModal = ( modal ) => {
	const firstStep = modal.querySelector( '.step1-wrapper' );
	const secondStep = modal.querySelector( '.step2-wrapper' );
	const thirdStep = modal.querySelector( '.step3-wrapper' );
	const closeBtn = modal.querySelector( '[data-dismiss="modal"]' );
	const emailInput = modal.querySelector( '#feedback-email-input' );
	const checkboxOptIn = modal.querySelector( '#feedback-opt-in' );
	const formNonce = modal.querySelector( '.step2-wrapper' ).dataset.nonce;

	modal.classList.remove( 'd-none', 'fade' );
	modal.style.display = 'block';
	// jQuery(modal).removeClass('fade').show(300).trigger('show.bs.modal');

	const responseData = {
		rating: 0,
		text: '',
		email: emailInput.value,
		optedForEmail: checkboxOptIn.checked,
	};

	const ratingChosenText = modal.querySelector( '.rating-chosen' );

	const commentInput = modal.querySelector( '#comments-text-input' );
	const commentSubmitBtn = modal.querySelector( '#comments-submit-btn' );

	const ratingsPicker = modal.querySelector( '.ratings-picker' );
	ratingsPicker.querySelectorAll( 'li' ).forEach( ( li, index ) => {
		li.addEventListener( 'click', ( evt ) => {
			firstStep.classList.add( 'df-spl-d-none' );
			secondStep.classList.remove( 'df-spl-d-none' );
			ratingChosenText.textContent = index + 1;
			responseData.rating = index + 1;
		} );
	} );

	commentInput.addEventListener( 'input', ( evt ) => {
		responseData.text = evt.target.value;
	} );

	emailInput.addEventListener( 'input', ( evt ) => {
		responseData.email = evt.target.value;
	} );

	checkboxOptIn.addEventListener( 'change', ( evt ) => {
		responseData.optedForEmail = evt.target.checked;
		if ( ! evt.target.checked ) {
			delete responseData.email;
		}
	} );

	commentSubmitBtn.addEventListener( 'click', ( evt ) => {
		jQuery.ajax( {
			url:
          ajaxurl +
          '?action=df_spl_feedback_manage' +
          '&_wpnonce=' +
          formNonce,
			type: 'POST',
			contentType: 'application/json; charset=utf-8',
			dataType: 'json',
			data: JSON.stringify( responseData ),
			beforeSend() {
				commentSubmitBtn.disabled = true;
				commentSubmitBtn.textContent = 'Submitting...';
			},
			complete( data ) {
				secondStep.classList.add( 'd-none' );
				thirdStep.classList.remove( 'd-none' );
				closeBtn.classList.add( 'd-none' );
		  if ( responseData.rating == 5 ) {
					window.location.href = 'https://wordpress.org/support/plugin/stylish-price-list/reviews/#new-post';
				}
				setTimeout( () => {
					document.querySelector( '#user-scc-sv' ).classList.remove( 'd-block' );
					document.querySelector( '#user-scc-sv' ).classList.add( 'fade', 'd-none' );
					document.querySelector( '#user-scc-sv' ).style.display = 'none';
				}, 300 );
			},
		} );
	} );
};

function sccSkipFeedbackModal() {
	const formNonce = document.querySelector( '.step2-wrapper' ).dataset.nonce;
	jQuery.post( ajaxurl +
		'?action=df_spl_feedback_manage' +
		'&_wpnonce=' +
		formNonce, {
	  'btn-type': 'skip',
	}, function( response ) {
	  document.querySelector( '#user-scc-sv' ).style.display = 'none';
	} );
}
