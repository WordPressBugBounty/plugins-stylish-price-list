
function add_service( service_link ) {
	checkIfMaxVarsReached();
	service_link = jQuery( service_link );
	const category_row = get_category_row_from_add_remove_service_link( service_link );
	const service_rows = category_row.find( '.service' );
	const service_rows_count = service_rows.length;
	const evaluation = splEvaluate( service_rows_count, 'service' );
	if ( evaluation ) {
		service_link.html( 'need license to add more services' );
	} else {
		const service_rows_clone = jQuery( '#category-row-template .service' ).clone();
		const service_rows_wrapper = service_link.parent().siblings('.service-container');
		service_rows_wrapper.append( service_rows_clone );
		update_all_service_rows_html_in_wrapper( category_row );
		imagePickerEventHandler( service_rows_wrapper[0] );
		loadStylishUploadButton( service_rows_wrapper );
	}
}

function copy_service( copy_icon ) {
	copy_icon = jQuery( copy_icon );
	const category_row = get_category_row_from_copy_icon( copy_icon );
	const service_rows = category_row.find( '.service' );
	const service_rows_count = service_rows.length;
	const evaluation = splEvaluate( service_rows_count, 'service' );
	if ( evaluation ) {
		copy_icon.html( 'need license to add more services' );
	} else {
		const service_rows_clone = jQuery( '#category-row-template .service' ).clone();
		const service_rows_wrapper = get_service_rows_from_copy_icon( copy_icon );
		const service_row_data_nodes = {
			item_name: 'input.service_name',
			long_description: 'textarea.service_long_description',
			price: 'input.service_price',
			description: 'input.service_desc',
			button_txt: 'input.service_button',
			button_url: 'input.service_button_url',
			product_img: '.spl_service_image_element img[src]',
			product_img_url: '.spl_service_image_element input[type="hidden"]',
			compare_at_price: 'input.service-compare-at-price',
			is_popular: 'input.is_popular',
			popular_text: 'input.popular_text',
			tooltip_title: 'input.service-tooltip-title',
			tooltip_description: 'input.service-tooltip-description',
			tooltip_img: 'img.service-tooltip-image',
			tooltip_img_url: 'input.service-tooltip-image-url',
		};
		const current_service_row_data = {};
		Object.keys( service_row_data_nodes ).forEach(
			( e ) => {
				if ( ['product_img', 'tooltip_img'].includes( e ) ) {
					current_service_row_data[ e ] = service_rows_wrapper.find( service_row_data_nodes[ e ] ).attr( 'src' );
					return;
				}
				if ( e == 'product_img_url' ) {
					current_service_row_data[ e ] = service_rows_wrapper.find( service_row_data_nodes[ e ] ).attr( 'value' );
					return;
				}
				if ( e == 'is_popular' ) {
					current_service_row_data[ e ] = service_rows_wrapper.find( service_row_data_nodes[ e ] ).prop( 'checked' );
					return;
				}
				current_service_row_data[ e ] = service_rows_wrapper.find( service_row_data_nodes[ e ] ).val();
			},
		);
		Object.keys( service_row_data_nodes ).forEach(
			( e ) => {
				// service_rows_wrapper
				if ( ['product_img', 'tooltip_img'].includes( e ) ) {
					service_rows_clone.find( service_row_data_nodes[ e ] ).attr( 'src', current_service_row_data[ e ] );
					return;
				}
				if ( e == 'product_img_url' ) {
					service_rows_clone.find( service_row_data_nodes[ e ] ).attr( 'value', current_service_row_data[ e ] );
					return;
				}
				if ( e == 'is_popular' ) {
					service_rows_clone.find( service_row_data_nodes[ e ] ).prop( 'checked', current_service_row_data[ e ] );
					return;
				}
				service_rows_clone.find( service_row_data_nodes[ e ] ).val( current_service_row_data[ e ] );
			},
		);
		service_rows_wrapper.after( service_rows_clone );
		update_all_service_rows_html_in_wrapper( category_row );
	}
}

function remove_service( service_link ) {
	service_link = jQuery( service_link );
	const category_row = get_category_row_from_add_remove_service_link( service_link );
	const service_row = get_service_rows_from_add_remove_service_link( service_link );
	service_row.remove();
	update_all_service_rows_html_in_wrapper( category_row );
	const service_rows = category_row.find( '.service' );
	if ( 0 == service_rows.length ) {
		category_row.remove();
	}
}

function update_all_service_rows_html_in_wrapper( category_row ) {
	const service_rows = category_row.find( '.service' );
	if ( 0 < service_rows.length ) {
		cat_id = get_category_id( category_row );
		for ( let i = 0; i < service_rows.length; i++ ) {
			service_id = i + 1;
			update_service_rows_html( jQuery( service_rows[ i ] ), cat_id, service_id );
		}
	}
}

function add_category( add_cat_row_ele ) {
	const cat_clone = jQuery( '#category-row-template .category-row' ).clone();
	const cat_id = parseInt( get_category_id( jQuery( '#category-rows-wrapper' ) ) ) + 1;
	let cat_count = parseInt( get_category_count( jQuery( '#category-rows-wrapper' ) ) );
	// category ID max amount
	var category_max = parseInt( get_category_max( jQuery( '#category-rows-wrapper' ) ) );
	if ( cat_id == 8 && cat_count >= 7 ) {
		jQuery( '#dropdown_tips' ).removeClass( 'fade' ).show( 300 ).trigger( 'show.bs.modal' );
	}
	const service_id = 1;
	const evaluation = splEvaluate( cat_count, 'category' );
	if ( evaluation ) {
		show_license_tips_for_category( add_cat_row_ele );
	} else {
		var category_max = parseInt( get_category_max( jQuery( '#category-rows-wrapper' ) ) );
		update_category_row_html( cat_clone, category_max + 1, service_id );
		cat_clone.appendTo( '#category-rows-wrapper .categories' );
		makeServiceSortable(cat_clone.children(".service-container")[0]);
		cat_count = parseInt( get_category_count( jQuery( '#category-rows-wrapper' ) ) );
		if ( cat_count >= splSettings.maxCats ) {
			show_license_tips_for_category( add_cat_row_ele );
		}
	}
}

function splEvaluate( count, type ) {
	if ( type == 'category' ) {
		return count >= splSettings.maxCats;
	}
	if ( type == 'service' ) {
		return count >= splSettings.maxService;
	}
}

function show_license_tips_for_category( add_cat_row_ele ) {
	jQuery( add_cat_row_ele ).html( 'need license to add more categories' ); jQuery( add_cat_row_ele ).parent().removeClass( 'col-xs-3 col-sm-3 col-md-3 col-lg-3' ); jQuery( add_cat_row_ele ).parent().addClass( 'col-xs-5 col-sm-5 col-md-5 col-lg-5' );
}

jQuery( document ).on(
	'click',
	'.spl_service_button_enable',
	function() {
		if ( this.checked ) {
			var e = jQuery( this ).data( 'id' ); jQuery( '.' + e + '_service_button_url' ).css( 'display', 'block' ), jQuery( '.' + e + '_service_button_url' ).parent().parent().css( 'display', 'block' );
		} else {
			e = jQuery( this ).data( 'id' ); jQuery( '.' + e + '_service_button' ).val( '' ),
			jQuery( '.' + e + '_service_button_url' ).css( 'display', 'none' ),
			jQuery( '.' + e + '_service_button_url' ).parent().parent().css( 'display', 'none' );
		}
	},
);

jQuery( "input[type='checkbox']" ).each(
	function() {
		if ( jQuery( this ).attr( 'checked' ) ) {
			var e = jQuery( this ).data( 'id' ); jQuery( '.' + e + '_service_button_url' ).css( 'display', 'block' ), jQuery( '.' + e + '_service_button_url' ).parent().parent().css( 'display', 'block' );
		} else {
		 e = jQuery( this ).data( 'id' ); jQuery( '.' + e + '_service_button' ).val( '' ),
		  jQuery( '.' + e + '_service_button_url' ).css( 'display', 'none' ),
		  jQuery( '.' + e + '_service_button_url' ).parent().parent().css( 'display', 'none' );
		}
	},
);

function loadStylishUploadButton( queryRoot = document ) {
	// if ( jQuery('.stylish-upload-btn .upload-btn', queryRoot ).attr( 'data-event-listener-registered' ) === '1' ) {
	// 	return;
	// }
	jQuery('.stylish-upload-btn .upload-btn', queryRoot).click(function () {
		jQuery(this).siblings('input[type="file"]').click();
	});
	// jQuery('.stylish-upload-btn .upload-btn').attr( 'data-event-listener-registered', 1 );
}

const handlePreviewDockMode = ( element, mode, event, scrollTo = true ) => {
	if ( event ) {
		event.preventDefault();
	}
	const pricelistEditorRoot = document.querySelector( '#pricelist-editor-root' );
	const leftPane = document.querySelector( '#category-rows-wrapper' );
	const floatingDockSwitcher = document.querySelector( '.floating-dock-switcher' );
	const buttons = document.querySelectorAll( '[data-dock-mode]' );
	const previewPane = document.querySelector( '.spl-preview' );
	const secondaryNav = document.querySelector( '.navbar.navbar-secondary' );
	const moreSettingsWrapper = document.querySelector( '#more-settings-wrapper' );
	const priceListEditorForm = document.querySelector( '#main_form' );
	const style5ExtraOptions = document.querySelector( '#style5_category_container' );
	// remove btn-primary from all buttons
	buttons.forEach( ( button ) => {
		button.classList.remove( 'btn-primary' );
	} );
	if ( mode == 'bottom' ) {
		pricelistEditorRoot.classList.add( 'preview-docked-bottom');
		leftPane.classList.add( 'preview-docked-bottom' );
		secondaryNav.classList.add( 'preview-docked-bottom');
		style5ExtraOptions.classList.add( 'preview-docked-bottom');
		moreSettingsWrapper.classList.add( 'preview-docked-bottom');
		const dockToBottomBtns = document.querySelectorAll( '[data-dock-mode="bottom"]' );
		dockToBottomBtns.forEach( ( btn ) => {
			btn.classList.add( 'btn-primary' );
		} );
		floatingDockSwitcher?.classList.remove( 'df-spl-d-none' );
		priceListEditorForm?.classList.add( 'preview-docked-bottom' );
		if ( event ) {
			if ( scrollTo ) {
				previewPane.scrollIntoView( { behavior: 'smooth' } );
				previewPane.scrollTop = previewPane.scrollHeight;
			}
			previewPane.classList.add( 'preview-docked-bottom' );
			const priceListItemFieldLabels = document.querySelectorAll( '.col-xs-6.col-sm-5.col-md-5.col-lg-5.lbl' );
			priceListItemFieldLabels.forEach( ( label ) => {
				label.classList.remove( 'col-xs-6', 'col-sm-5', 'col-md-5', 'col-lg-5' );
				label.classList.add( 'col-xs-2', 'col-sm-2', 'col-md-2', 'col-lg-2' );
				const nextSibling = label.nextElementSibling;
				nextSibling.classList.remove( 'col-xs-6', 'col-sm-7', 'col-md-7', 'col-lg-7' );
				if ( label.classList.contains( 'price-input-wrapper' ) ) {
					nextSibling.classList.add( 'col-xs-5', 'col-sm-5', 'col-md-5', 'col-lg-5' );
				} else {
					nextSibling.classList.add( 'col-xs-10', 'col-sm-10', 'col-md-10', 'col-lg-10' );
				}
			});
		}
	}
	if ( mode == 'right' ) {
		pricelistEditorRoot.classList.remove( 'preview-docked-bottom' );
		leftPane.classList.remove( 'preview-docked-bottom' );
		secondaryNav.classList.remove( 'preview-docked-bottom' );
		style5ExtraOptions.classList.remove( 'preview-docked-bottom' );
		priceListEditorForm.classList.remove( 'preview-docked-bottom' );
		moreSettingsWrapper.classList.remove( 'preview-docked-bottom' );
		const dockToRightBtns = document.querySelectorAll( '[data-dock-mode="right"]' );
		dockToRightBtns.forEach( ( btn ) => {
			btn.classList.add( 'btn-primary' );
		} );
		if ( event ) {
			if ( scrollTo ) {
				previewPane.scrollIntoView( { behavior: 'smooth' } );
				previewPane.scrollTop = previewPane.scrollHeight;
			}
			previewPane.classList.remove( 'preview-docked-bottom' );
			const priceListItemFieldLabels = document.querySelectorAll( '.col-xs-2.col-sm-2.col-md-2.col-lg-2.lbl' );
			priceListItemFieldLabels.forEach( ( label ) => {
				label.classList.remove( 'col-xs-2', 'col-sm-2', 'col-md-2', 'col-lg-2' );
				label.classList.add( 'col-xs-6', 'col-sm-5', 'col-md-5', 'col-lg-5' );
				const nextSibling = label.nextElementSibling;
				if ( label.classList.contains( 'price-input-wrapper' ) ) {
					nextSibling.classList.remove( 'col-xs-5', 'col-sm-5', 'col-md-5', 'col-lg-5' );
					nextSibling.classList.add( 'col-xs-6', 'col-sm-7', 'col-md-7', 'col-lg-7' );
				} else {
					nextSibling.classList.add( 'col-xs-6', 'col-sm-7', 'col-md-7', 'col-lg-7' );
					nextSibling.classList.remove( 'col-xs-10', 'col-sm-10', 'col-md-10', 'col-lg-10' );
				}
			});
		}
	}
};

function makeServiceSortable(ServiceEl){
	Sortable.create(ServiceEl, {
		group: 'foo',
		scrollSensitivity: 100,
		ghostClass: 'bg-sort-ghost',
		scrollSpeed: 10,
		preventOnFilter:false,
		handle: '.fas.fa-arrows-alt',
		forceFallback: true,
		animation: 100,
		onEnd: function (evt, z) {
			let category_row = jQuery(evt.from.previousElementSibling);
			const original_category_row = category_row[0];
			const target_category_row = evt.to.previousElementSibling;
			if (original_category_row == target_category_row) {
				update_all_service_rows_html_in_wrapper( category_row );
			}
			if (original_category_row !== target_category_row) {
				var last_ser_col_id = jQuery(target_category_row).next().children().last().find('.service_name').attr('id');
				var sortable_cat_num = jQuery(evt.item).find('.service_name').attr('id');
				var sortable_cat_num = sortable_cat_num.split("_");
				var sortable_cat_number = sortable_cat_num[1];
				var dropped_cat_num = last_ser_col_id.split("_");
				var dropped_cat_number = dropped_cat_num[1];
				var dropped_ser_number = jQuery(evt.item).parent().children('.service').length;
				var service_name_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_service_name';
				var service_price_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_service_price';
				var service_desc_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_service_desc';
				var ser_btn_enable_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_ser_btn_enable';
				var service_button_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_service_button';
				var service_button_url_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_service_button_url';
				var service_image_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_service_image';
				var service_regular_price_id = 'category_'+dropped_cat_number+'_'+dropped_ser_number+'_service_regular_price';
				jQuery( evt.item ).children().find('.service_name').attr('id',service_name_id);
				jQuery( evt.item ).children().find('.service_name').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_name]');
				jQuery( evt.item ).children().find('.service_price').attr('id',service_price_id);
				jQuery( evt.item ).children().find('.service_price').parent().addClass('price-input');
				jQuery( evt.item ).children().find('.service_price').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_price]');
				jQuery( evt.item ).children().find('.service_regular_price').attr('id',service_regular_price_id);
				jQuery( evt.item ).children().find('.service_regular_price').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_regular_price]');
				jQuery( evt.item ).children().find('.service_desc').attr('id',service_desc_id);
				jQuery( evt.item ).children().find('.service_desc').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_desc]');
				jQuery( evt.item ).children().find('.spl_service_button_enable').attr('id',ser_btn_enable_id);
				jQuery( evt.item ).children().find('.spl_service_button_enable').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_button_enable]');
				jQuery( evt.item ).children().find('.service_button').attr('id',service_button_id);
				jQuery( evt.item ).children().find('.service_button').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_button]');
				jQuery( evt.item ).children().find('.service_button_url').attr('id',service_button_url_id);
				jQuery( evt.item ).children().find('.service_button_url').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_button_url]');
				jQuery( evt.item ).children().find('.service_image').attr('id',service_image_id);
				jQuery( evt.item ).children().find('.service_image').attr('name','category['+dropped_cat_number+']['+dropped_ser_number+'][service_image]');
				update_all_service_rows_html_in_wrapper(jQuery( evt.item ).parent().parent());
			}
		}
	});
}

// handle image picking for Product/Service Image

const imagePickerEventHandler = ( queryRoot = document ) => {
	queryRoot.querySelectorAll( '.form-control.service_image, .form-control.service-tooltip-img, .form-control.category_image[type=file]' ).forEach( ( fileInput ) => {
		// if ( fileInput.getAttribute( 'data-event-listener-registered' ) ) {
		// 	return;
		// }
		fileInput.addEventListener( 'click', ( evt ) => {
			evt.preventDefault();

			const inputSrc = evt.target;

			const mediaUploader = wp.media.frames.file_frame = wp.media( {
				title: 'Choose Image',
				button: {
					text: 'Choose Image',
				},
				multiple: false,
			} );
			
			mediaUploader.on( 'select', () => {
				splOnMediaImageSelect( mediaUploader, inputSrc );
			} );

			mediaUploader.open();
		} );
		// fileInput.setAttribute( 'data-event-listener-registered', 1 );
	} );
}

/**
 * On media image select
 * @param mediaUploader
 * @param inputSrc
 */
function splOnMediaImageSelect( mediaUploader, inputSrc ) {
	const attachment = mediaUploader.state().get( 'selection' ).first().toJSON();

	function gcd( a, b ) {
		if ( b == 0 ) {
			return a;
		}
		return gcd( b, a % b );
	}

	const isCategoryImage = inputSrc.classList.contains( 'category_image' );

	if ( isCategoryImage ) {

		const dimensions_gcd = gcd( attachment.width, attachment.height );
		const aspectRatio = [ attachment.width / dimensions_gcd, attachment.height / dimensions_gcd ];
		if ( aspectRatio[ 0 ] == aspectRatio[ 1 ] || aspectRatio[ 0 ] < aspectRatio[ 1 ] ) {
			jQuery( '#image_bad_aspect_ratio_warning' ).removeClass( 'fade' ).show( 300 ).trigger( 'show.bs.modal' );
			
			return;
		}
		
	}

	if ( [ 'jpeg', 'png' ].findIndex( ( type ) => type == attachment.subtype ) < 0 ) {
		jQuery( '#not_an_image_warning' ).removeClass( 'fade' ).show( 300 ).trigger( 'show.bs.modal' );
		return;
	}
	
	jQuery( inputSrc ).closest('.service-price-length').find( 'img' ).attr( 'src', attachment.url );
	jQuery( inputSrc ).closest('.category-image-wrapper').find( 'img' ).attr( 'src', attachment.url );
			
		jQuery( inputSrc ).parent().find( 'input:hidden' ).val( attachment.url );	
		
		jQuery( inputSrc ).parent().find( 'input[type=file]' ).css('display', 'none');
		const html = `<div class="spl-container"> <div class="spl-container-icon">${attachment.filename} 
		<i class='spl-icon'>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#dae2e1" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
		</i>

		</div></div>`;
		jQuery( inputSrc ).parent().append(html);
}

// initiate tooltip

window.onload = function() {
	jQuery('[title]').tooltip();
	jQuery( '[data-tooltip-image-key]' ).tooltip({
		classes: {
			"ui-tooltip": "ui-corner-all ui-widget-shadow ui-widget-has-images"
		},
		items: ".service-price-length .lbl",
		content: function() {
			const {tooltipImageKey} = this.querySelector('[data-tooltip-image-key]').dataset;
			const imageLink = itemFieldTooltipImages[tooltipImageKey];
			return `<img src=${imageLink} style="height: 430px;">`;
		}
	});
	const accordions = document.querySelectorAll('.styled-accordion .title');
	accordions.forEach((accordion) => {
		accordion.addEventListener('click', (event) => {
			const content = accordion.nextElementSibling;
			const titleIcon = accordion.querySelector('.fas');
			if ( titleIcon.classList.contains('fa-angle-down') ) {
				titleIcon.classList.remove('fa-angle-down');
				titleIcon.classList.add('fa-angle-up');
				content.classList.add('show');
			} else {
				titleIcon.classList.remove('fa-angle-up');
				titleIcon.classList.add('fa-angle-down');
				content.classList.remove('show');
			}
			
		});
	});
	jQuery( '.category-image-wrapper' ).tooltip();
	const colorPickers = document.querySelectorAll('toolcool-color-picker');
	colorPickers.forEach((colorPicker) => {
		const targetInput = colorPicker.getAttribute('data-target');
		const targetInputElement = document.getElementById(targetInput);
		colorPicker.addEventListener('change', (evt) => {
			targetInputElement.value = evt.detail.hex;
		});
		targetInputElement.addEventListener('change', (evt) => {
			colorPicker.color  = evt.target.value;
		});
	});

	loadStylishUploadButton();

	// image tooltip setup

	jQuery( '[data-image-tooltip]' ).on(
		'click',
		function( event ) {
			const settingsModal = jQuery( '#settings-preview' );
			const imgLink = this.attributes[ 'data-image-tooltip' ].value;
			const imgTag = jQuery( '<img>' ).attr( 'src', imgLink );
			settingsModal.find( '.df-spl-row' ).html( imgTag );
			// settingsModal.modal( {'show': true, 'backdrop': true} );
			settingsModal.removeClass( 'fade' ).show( 300 ).trigger( 'show.bs.modal' );
			jQuery( 'button[data-dismiss="modal"]', settingsModal ).on( 'click', ( ee ) => {
				settingsModal.addClass( 'fade' ).hide( 300 ).trigger( 'hide.bs.modal' );
			} );
		},
	);

	// get the viewport width
	const vw = Math.max( document.documentElement.clientWidth || 0, window.innerWidth || 0 );
	if ( vw >= 1401 ) {
		handlePreviewDockMode( document.querySelector('[data-dock-mode="right"]'), 'right', new Event( 'click' ), false );
	}
	if ( vw < 1400 ) {
		handlePreviewDockMode( document.querySelector('[data-dock-mode="bottom"]'), 'bottom', new Event( 'click' ), false );
	}

	// INITIATING SORTING CAPABILITY FOR THE CATEGORIES
	document.querySelectorAll('#category-rows-wrapper .categories').forEach((category,index) => {
		Sortable.create(category, {
			group: 'foo1',
			scrollSensitivity: 100,
			scrollSpeed: 10,
			handle: '.heading-catag .fas.fa-arrows-alt',
			forceFallback: true,
			animation: 100,
		});
	});

	// tomSelect for picking the fonts
	const fontPickerIds = ['list_name_font', 'title_font', 'desc_font', 'price_font', 'service_description_font', 'tab_description_font' ];

	fontPickerIds.forEach( ( fontPickerId ) => {
		const fontPicker = document.getElementById( fontPickerId );
		if ( fontPicker ) {
			new TomSelect( fontPicker, {
				plugins: [],
				create: false,
			} );
		}
	});

	imagePickerEventHandler();

	let splListType = jQuery('.spl-list-type-selector').val();
	if(splListType == 'pricing_table') {
		jQuery('.spl-pricing-table-row').removeClass('df-spl-d-none');
		jQuery('.service_price').closest('.service-price-length').addClass('df-spl-d-none');
	}
	
	
};
	
	jQuery(document).on('click', '.delete-icon', function() {
		var container = jQuery(this).closest('.spl-container-test');
		var parentDiv = container.parent();
		var defaultImageSrc = SPL_admin_url.url + "../wp-content/plugins/stylish-price-list/assets/images/def-thumb.png";
		parentDiv.parent().find('img').attr('src', defaultImageSrc);
		parentDiv.find('input[type="hidden"]').val('');
	
		var inputFile = jQuery('#spl-file-input');
		inputFile.removeAttr('style');
		inputFile.css('display', 'block');
		

		var inputFile = jQuery('.spl-include-close');
		inputFile.removeAttr('style');
		inputFile.css('display', 'block');
		

		parentDiv.find('.spl-container-icon').css('display', 'none');
		
	});

			
	jQuery(document).on('click', '.spl-icon', function() {
		var container = jQuery(this).closest('.spl-container');
		var parentDiv = container.parent();
	
		
		container.remove();
	
		var fileInput = parentDiv.find('input[type="file"]');
		fileInput.css('display', 'block');
	

		parentDiv.find('input[type="hidden"]').val('');
		fileInput.val('');
	

		if (!fileInput.val()) {
			var defaultImageSrc = SPL_admin_url.url +"../wp-content/plugins/stylish-price-list/assets/images/def-thumb.png";
			parentDiv.parent().find('img').attr('src', defaultImageSrc);
			parentDiv.find('input[type="hidden"]').val('');
		}
		else {
			
		}
	});

	jQuery(document).on('change', '.spl-list-type-selector', function() {
		const listType = jQuery(this).val();
		const listTemplate = jQuery('.sel1[name="tab_style"]');
		if(listType == 'price_list') {
			jQuery('.spl-list-option').removeClass('df-spl-d-none');
			jQuery('.spl-table-option').addClass('df-spl-d-none');
			jQuery('.spl-pricing-table-row').addClass('df-spl-d-none');
			jQuery('.service_price').closest('.service-price-length').removeClass('df-spl-d-none');
		}
		else {
			jQuery('.spl-list-option').addClass('df-spl-d-none');
			jQuery('.spl-table-option').removeClass('df-spl-d-none');
			jQuery('.spl-pricing-table-row').removeClass('df-spl-d-none');
			jQuery('.sel1[name="tab_style"]').val('style_5');
			jQuery('.service_price').closest('.service-price-length').addClass('df-spl-d-none');
		}
		listTemplate.val('');
	});


	var isStyleChangeAccepted = true;
	jQuery(".sel1").change(function (e) {
	// check for isNoModal variable sent from trigger events
	var isNoModal = e.noModal ? e.noModal : false
	if (jQuery(this).val() == "with_tab") {
		false == isNoModal && jQuery('#sell1').removeClass('fade').show(300).trigger('show.bs.modal');
		// jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "without_tab") {
		!(isNoModal) && jQuery('#sell2').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "without_tab_single_column") {
		!(isNoModal) && jQuery('#sell2').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_3") {
		!(isNoModal) && jQuery('#sell3').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_4") {
		!(isNoModal) && jQuery('#sell4').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_5") {
		!(isNoModal) && jQuery('#sell5').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'block')
	}
	if (jQuery(this).val() == "style_6") {
		!(isNoModal) && jQuery('#sell6').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_7") {
		!(isNoModal) && jQuery('#sell7').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_8") {
		!(isNoModal) && jQuery('#sell8').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_10") {
		!(isNoModal) && jQuery('#sell10').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.df-spl-row.category-cover-image-row').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none');
	}
	if (jQuery(this).val() !== "style_10") {
		// !(isNoModal) && jQuery('#sell7').modal('show');
		jQuery('.df-spl-row.category-cover-image-row').hide();
	}

	if (jQuery(this).val() == "style_table_1") {
		!(isNoModal) && jQuery('#selt1').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.df-spl-row.category-cover-image-row').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none');
	}
	if (jQuery(this).val() == "style_table_2") {
		!(isNoModal) && jQuery('#selt2').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.df-spl-row.category-cover-image-row').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none');
	}
});
	function handleFeedbackButtons(btn, event) {
	  event.preventDefault();
	  console.log();
	  jQuery.post(ajaxurl, {
		'action': 'df_spl_feedback_manage',
		'btn-type': jQuery(btn).data('btnType'),
		'_ajax_nonce' : jQuery(btn).parent().data('nonce')
	}, function(response) {
		jQuery('#userSurvey').addClass('fade').hide(300).trigger('hide.bs.modal');
		var link = jQuery(btn).attr('href');
		if (link) {
			window.open(link, '_blank');
		}
	});
  }
// Register modals and the buttons inside it functions
var modalTags = ['#sell1', '#sell2', '#sell3', '#sell4', '#sell5', '#sell6', '#sell7', '#sell8', '#sell10', '#selt1', '#selt2'];
;(function(elements) {
	elements.forEach(e => {
		jQuery(e).on('show.bs.modal', function (e) {
			var previousStyleValue = styleDropdown.data('prev');
			jQuery(this).find('.cancel-btn').add('button[data-dismiss="modal"]', this).on('click', ee => {
				isStyleChangeAccepted = false;
				debugger;
				jQuery(this).addClass('fade').hide(300).trigger('hide.bs.modal');
				jQuery(ee.target).unbind();
				// set previous selected style and stop popup from invoking
				styleDropdown.val(previousStyleValue)
				.trigger({
					type: 'change',
					noModal: true
				});
			});
			jQuery(this).find('[data-btnType="keep-current"]').on('click', ee => {
				ee.target.innerHTML = '<i class="gg-spinner"></i>';
				if (styleDropdown.val() == 'style_3') {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Two' );
					jQuery( 'select[name="select_column"]' ).val( 'Two' );
				} else {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Columns' );
				}
				jQuery(ee.target).unbind();
				jQuery('#submit_tabs').click();
			});
			jQuery(this).find('[data-btnType="use-demo"]').on('click', ee => {
				ee.target.innerHTML = '<i class="gg-spinner"></i>';
				// sending events so the events function will execute
				styleDropdown.trigger('load-demo-settings');

				if (styleDropdown.val() == 'style_3') {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Two' );
					jQuery( 'select[name="select_column"]' ).val( 'Two' );
				} else {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Columns' );
				}
				jQuery(ee.target).unbind();
				jQuery('#submit_tabs').click();
			});
		});
		jQuery(e).on('hide.bs.modal', function (e) {
			debugger;
			isStyleChangeAccepted && styleDropdown.data('prev', styleDropdown.val());
			// reset style change value
			isStyleChangeAccepted = true;
		});
	})
})(modalTags);
jQuery('#dropdown_tips').add('#not_an_image_warning').add('#image_bad_aspect_ratio_warning').on('show.bs.modal', function (e) {
	jQuery(this).find('span[data-dismiss="modal"]', this).on('click', ee => {
		jQuery(this).addClass('fade').hide(300).trigger('hide.bs.modal');
		jQuery(ee.target).unbind();
	});
});

		