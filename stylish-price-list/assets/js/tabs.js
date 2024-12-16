const isBreakPoint = function( bp, root = window ) {
	let bps = [ 320, 480, 600, 768, 1024 ],
		w = jQuery( root ).width(),
		min, max;
	for ( let i = 0, l = bps.length; i < l; i++ ) {
		if ( bps[ i ] === bp ) {
			min = bps[ i - 1 ] || 0;
			max = bps[ i ];
			break;
		}
	}
	return w > min && w <= max;
};

const style10SpyScrolling = ( ) => {
	const categories = document.querySelectorAll( '.spl-s10-cat-wrapper' );
	const priceListRoot = document.querySelector( '.style-10.spl_main_content_box' );
	const priceListNumberOfColumns = priceListRoot.getAttribute( 'data-list-columns' );

	const handleMobileResize = () => {
		const isMobileView = isBreakPoint( 600, priceListRoot ) || isBreakPoint( 480, priceListRoot );
		categories.forEach(category => {
			const categoryListWrapper = category.querySelector( '.spl-s10-list-wrapper' );
			if ( categoryListWrapper && isMobileView ) {
				categoryListWrapper.classList.remove( 'spl-s10-two-cols' );
			}
			if ( categoryListWrapper && !isMobileView ) {
				categoryListWrapper.classList.add( 'spl-s10-two-cols' );
			}
		});
	}
	if ( priceListNumberOfColumns == 'two' ) {
		handleMobileResize();
	}

	// on resize event handler
	if ( priceListNumberOfColumns == 'two' ) {
		window.onresize = ( ) => {
			handleMobileResize();
		};
	}

	window.onscroll = ( ) => {
	  const scrollPos = document.documentElement.scrollTop || document.body.scrollTop;

	  for ( const s in categories ) {
			if ( categories.hasOwnProperty( s ) && ( categories[ s ].offsetTop - 600 ) <= scrollPos ) {
				const id = categories[ s ].id;
				const activeElement = document.querySelector('.active');
				activeElement?.classList?.remove('active');
				const newActiveElement = document.querySelector(`a[data-href="#${id}"]`);
				newActiveElement.classList.add('active');
				newActiveElement.scrollIntoView({ block: 'nearest', inline: 'start' });
			}
		}
	};
};

function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

const dfSPLHandleTooltips = ( priceListId ) => {
	const priceListWrapper = document.querySelector(`[id=${ 'spl_' + priceListId }]`);
	const tooltips = Array.from(priceListWrapper.querySelectorAll(".spl-item-root"));
	const tooltipContainer = document.querySelector(`.df-spl-tooltip-container[data-price-list-id="${ priceListId }"]`);

	const data = [
		{id: 1, txt: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque possimus assumenda quis illo minus numquam voluptates nihil, doloremque unde non."},
		{id: 2, txt: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid, deleniti."},
		{id: 3, txt: "Lorem ipsum dolor sit amet."}
	]


	let tooltipID;
	tooltips.forEach((tooltip) => {
		let tooltipChild = tooltip.querySelectorAll('[data-price-list-fragment="item_name"]:not(.desc), [data-price-list-fragment="price"]:not(.desc)');
		// add child of the tooltipChild to the tooltipChild array
		tooltipChild = [...tooltipChild, Array.from(tooltipChild).map((child) => {
			return [...child.querySelectorAll('*')];
		}).flat()];
		let allTooltipChild = [ ...tooltipChild].flat().filter(Boolean);
		let title = tooltip.getAttribute('data-tooltip-title');
		let description = tooltip.getAttribute('data-tooltip-description');
		const imageLink = tooltip.getAttribute('data-tooltip-image');
		for (var i = 0; i < allTooltipChild.length; i++) {
			if ( title || description ) {
				title = title === null ? '' : title;
				description = description === null ? '' : description;
				const imageFragment = imageLink ? `<div class="spl-tooltip-image-container"><img src="${imageLink}" alt="tooltip-image" /></div>` : '';
				allTooltipChild[i].addEventListener("mouseenter", (e) => {
					tooltipID = e.target.getAttribute('data-id');
					tooltipContainer.classList.add("fade-in");
					tooltipContainer.style.left = `${e.pageX}px`;
					tooltipContainer.style.top = `${e.pageY}px`;
					tooltipContainer.innerHTML = `${imageFragment}<div class="spl-tooltip-content"><h5>${title}</h5><p>${description}</p></div>`;
				});
				allTooltipChild[i].addEventListener("mouseout", (e) => {
					tooltipContainer.classList.remove("fade-in");
				});
			}
		}
	});

	tooltipContainer.addEventListener('mouseenter', () => {

		tooltipContainer.classList.add("fade-in");

	})
	tooltipContainer.addEventListener('mouseout', () => {
		
		tooltipContainer.classList.remove("fade-in");

	})
};

jQuery( document ).ready(
	function( $ ) {
		$( '.spl_main_content_box[id^="spl_"]' ).each(
			( ii, ee ) => {
				const listId = $( ee ).attr( 'id' ).replace( 'spl_', '' );
				$( '.tab-links_spl li a', ee ).add( '.df-spl-style7_cat_tab-container li a', ee ).add( `.spl-style-10-footer-bottom[id^=spl10_${ listId }] .spl-style-10-nav` ).each(
					( i, e ) => {
						e.onclick = function( event ) {
							const config = $( ee ).data( 'config' );
							const targetTabId = event.currentTarget.getAttribute( 'data-href' ).replace( '#', '' );
							const isStyle10 = $( ee ).hasClass( 'style-10' );
							const targetTabNode = document.getElementById( targetTabId );
							if ( config?.category_select_scrolling == 1 || isStyle10 ) {
								setTimeout( () => {
									const yOffset = -300;
									const y = targetTabNode.getBoundingClientRect().top + window.pageYOffset + yOffset;
									window.scrollTo( { top: y, behavior: 'smooth' } );
								}, isStyle10 ? 10 : 300 );
							}
						};
					},
				);
			},
		);
		$( '.cats-dd' ).each(
			( i, e ) => {
            	const selection = new TomSelect(
					e,
					{
						create: true,
						allowEmptyOption: false,
						onChange: ( currentAttrValue ) => {
							jQuery( '.tabs_spl ' + currentAttrValue ).show().siblings().hide();
						},
						onInitialize() {
							if ( this.input.getAttribute( 'data-no-keyboard-popup' ) == 1 ) {
								if ( isBreakPoint( 600 ) || isBreakPoint( 480 ) ) {
									this.control_input.setAttribute( 'disabled', '' );
								}
							}
						},
					},
				);
			},
		);
		$( '.cats-dd-style6' ).each(
			( i, e ) => {
            	const selection = new TomSelect(
					e,
					{
						create: true,
						allowEmptyOption: false,
						onChange: ( currentAttrValue ) => {
							const targetItemCategoryKey = selection.options[currentAttrValue].targetCatKey;
							const pricelistRoot = selection.wrapper.closest('.style-6');
							const priceItemNodes = pricelistRoot.querySelectorAll('.service-item');
							const targetItems = pricelistRoot.querySelectorAll(`.service-item[data-cat-key="${targetItemCategoryKey}"]`);
							if ( ! targetItemCategoryKey ) {
								priceItemNodes.forEach((priceItemNode) => {
									priceItemNode.classList.remove('spl-hidden');
								});
								return;
							}
							priceItemNodes.forEach((priceItemNode) => {
								priceItemNode.classList.add('spl-hidden');
							});
							targetItems.forEach((targetItem) => {
								targetItem.classList.remove('spl-hidden');
							});
						},
						onInitialize() {
							const targetItemCategoryKey = this.options[this.input.value].targetCatKey;
							const pricelistRoot = this.wrapper.closest('.style-6');
							const priceItemNodes = pricelistRoot.querySelectorAll('.service-item');
							const targetItems = pricelistRoot.querySelectorAll(`.service-item[data-cat-key="${targetItemCategoryKey}"]`);
							if ( ! targetItemCategoryKey ) {
								priceItemNodes.forEach((priceItemNode) => {
									priceItemNode.classList.remove('spl-hidden');
								});
								return;
							}
							priceItemNodes.forEach((priceItemNode) => {
								priceItemNode.classList.add('spl-hidden');
							});
							targetItems.forEach((targetItem) => {
								targetItem.classList.remove('spl-hidden');
							});
							if ( this.input.getAttribute( 'data-no-keyboard-popup' ) == 1 ) {
								if ( isBreakPoint( 600 ) || isBreakPoint( 480 ) ) {
									this.control_input.setAttribute( 'disabled', '' );
								}
							}
						},
					},
				);
			},
		);
		$( '.cats-dd-style-8' ).each(
			( i, e ) => {
            	const selection = new TomSelect(
					e,
					{
						create: true,
						allowEmptyOption: false,
						onChange: ( currentAttrValue ) => {
							jQuery( '.style-8-container ' + currentAttrValue ).show( 300 ).siblings( '.tab' ).hide( 300 );
						},
						onInitialize() {
							if ( this.input.getAttribute( 'data-no-keyboard-popup' ) == 1 ) {
								if ( isBreakPoint( 600 ) || isBreakPoint( 480 ) ) {
									this.control_input.setAttribute( 'disabled', '' );
								}
							}
						},
					},
				);
			},
		);
		jQuery( '.tabs_spl .tab-links_spl a' ).on(
			'click',
			function( e ) {
				e.preventDefault();
				const currentAttrValue = jQuery( this ).attr( 'data-href' );
				jQuery( '.tabs_spl ' + currentAttrValue ).show().siblings().hide();
				jQuery( this ).parent( 'li' ).addClass( 'active' ).siblings().removeClass( 'active' );
			},
		);
		/* style 8 tab switch handler */
		jQuery( '.df-spl-style8_cat_tab-container ul li a' ).on(
			'click',
			function( e ) {
				e.preventDefault();
				const currentAttrValue = jQuery( this ).attr( 'data-href' );
				jQuery( '.style-8-container ' + currentAttrValue ).show( 300 ).siblings( '.tab' ).hide( 300 );
				jQuery( this ).parent( 'li' ).addClass( 'active' ).siblings().removeClass( 'active' );
			},
		);
		jQuery( '.spl-mysearch' ).keyup(
			function( event ) {
				const priceListId = $( event.currentTarget ).data( 'target' );
				const $priceList = $( '#' + priceListId );
				const style = $priceList.data( 'style' );
				let $priceItems = $priceList.find( '.internal-box' );
				let scanTargets = ['.name.a-tag', '.desc.a-tag', '[data-price-list-fragment="item_name"]'];
				if ( style === 'style_8') {
					$priceItems = $priceList.find( '.spl-item-root' );
					scanTargets.push('.style-8-title-container small');
				}
				let isStyle6 = false;
				if ( ! $priceItems.length ) {
					$priceItems = $priceList.find( '.name-price-desc' );
				}
				if ( style === 'style_6' ) {
					$priceItems = $priceList.find('.service-item');
					isStyle6 = true;
					scanTargets = ['h3', 'p'];
				}
				// var $rows = $('#table tr');
				const val = $.trim( $( this ).val() ).replace( / +/g, ' ' ).toLowerCase();
				const filtered = $priceItems.show().filter(
					function() {
						const text = $( this ).find( scanTargets.join( ',' ) ).text().replace( /\s+/g, ' ' ).toLowerCase();
						return ! ~text.indexOf( val );
					},
				);
				filtered.hide();
				switch ( style ) {
					case 'style_3':
						$( '.grid-sizer', $priceList ).show().filter( ( i, e ) => ! Boolean( $( e ).find( '.internal-box:visible' ).length ) ).hide();
						break;
					case 'style_6':
						$priceItems.each( ( index, row ) => {
							if ( row.style.display !== 'none' ) {
								row.style.display = 'flex';
							}
						});
						break;
					case ( 'without_tab' ):
						$( '.head-title.tab-links_spl.spl_cat_title_style_2' ).show().next( '.cat_descreption.row' ).show();
						$( '.style-2-row', $priceList ).show().filter( ( i, e ) => ! Boolean( $( e ).find( '.name-price-desc:visible' ).length ) )
							.each( ( i, e ) => $( e ).prevAll( '.head-title.tab-links_spl.spl_cat_title_style_2:eq(0)' ).hide().next( '.cat_descreption.row' ).hide() );
						break;
					case ( 'without_tab_single_column' ):
						$( '.head-title.tab-links_spl.spl_cat_title_style_2' ).show().next( '.cat_descreption.row' ).show();
						$( '.style-2-row', $priceList ).show().filter( ( i, e ) => ! Boolean( $( e ).find( '.name-price-desc:visible' ).length ) )
							.each( ( i, e ) => $( e ).prevAll( '.head-title.tab-links_spl.spl_cat_title_style_2:eq(0)' ).hide().next( '.cat_descreption.row' ).hide() );
						break;
					case ( 'style_4' ):
						// show them up before applying hide operation
						$( '.head-title.tab-links_spl.head_title_style_3.spl_cat_heading_style_4', $priceList ).show().next( '.cat_descreption.row' ).show();
						// filtering out the grids with items in it
						$( '.for-style-4' ).filter( ( i, e ) => ! Boolean( $( e ).find( '.internal-box:visible' ).length ) )
							.each( ( i, e ) => $( e ).find( '.head-title.tab-links_spl.head_title_style_3.spl_cat_heading_style_4' ).hide().next( '.cat_descreption.row' ).hide() );
						break;
					default:
						break;
				}
			},
		);
		const sliderHandles = document.querySelectorAll('#spl-slider-handles');
		sliderHandles.forEach((sliderHandle) => {
			const priceListRoot = sliderHandle.closest('.spl_main_content_box');
			const itemsAndPrices = [ ...( priceListRoot.querySelectorAll('.spl-item-root [data-price]') ) ]
				.map(price => ({
					itemRoot: price.closest('.spl-item-root'),
					price: Number(price.getAttribute('data-price').replace(/[^\d.]/g, ''))
				}));
			const prices = itemsAndPrices.map(x => x.price);
			const pricesUnique = [...new Set(prices)];
			const minPrice = Math.min(...prices);
			const maxPrice = Math.max(...prices);
			const sliderInstance = noUiSlider.create(sliderHandle, {
				start: [minPrice, maxPrice],
				connect: true,
				range: {
					'min': [minPrice],
					'max': [maxPrice]
				},
				step: 1,
				pips: {
					mode: 'positions',
					values: pricesUnique,
					density: 4
				},
				tooltips: [
					{
						to: function(value) {
							return Math.round(value);
						}
					},
					{
						to: function(value) {
							return Math.round(value);
						}
					}
				]
			});
			sliderInstance.on('change', (values, handle) => {
				const [min, max] = values;
				const items = itemsAndPrices.filter(item => item.price >= min && item.price <= max);
				items.forEach(item => item.itemRoot.style.display = 'block');
				itemsAndPrices.filter(item => !items.includes(item)).forEach(item => item.itemRoot.style.display = 'none');
			});
		});
		jQuery( '.df-spl-style7_cat_tab-container.tabs_spl ul a' ).on(
			'click',
			function( e ) {
				e.preventDefault();
				const currentAttrValue = jQuery( this ).attr( 'data-href' );
				jQuery( '.tabs_spl ' + currentAttrValue ).show().siblings().hide();
				if ( isBreakPoint( 600 ) || isBreakPoint( 480 ) ) {
					jQuery( 'html, body' ).animate(
						{
							scrollTop: ( jQuery( '.tabs_spl ' + currentAttrValue ).offset().top ) - 100,
						},
						500,
					);
				}
				jQuery( this ).parent( 'li' ).addClass( 'active' ).siblings().removeClass( 'active' );
			},
		);
		if ( typeof( splSettings ) === 'undefined' ) {
			return;
		}
		const applyFormula = () => {
			document.querySelectorAll( 'input, textarea' ).forEach( ( x ) => {
				x.setAttribute( 'disabled', 1 );
			} );
			const saveButton = document.querySelector( '.main-save .btn-primary' );
			saveButton.classList.add( 'disabled' );
			saveButton.setAttribute( 'disabled', 1 );
			saveButton.setAttribute( 'onclick', 'return false;' );
			document.querySelector( 'select[name="tab_style"]' ).setAttribute( 'disabled', 1 );
			if ( splSettings.update_state !== null ) {
				document.querySelector( '#edit-page-alert' ).classList.remove( 'd-none' );
			}
		}
		if ( ['expired', 'disabled'].includes(splSettings.update_state) ) {
			applyFormula();			
		}
		if ( splSettings.update_state === null ) {
			const categories = document.querySelectorAll( '.category-row.ui-widget-content' );
			const categoryCount = categories.length;
			if ( categoryCount > 4 ) {
				applyFormula();
				return;
			}
			let serviceCount = 0;
			categories.forEach( ( category ) => {
				serviceCount += category.querySelectorAll( '.service-price-length-rows-wrapper' ).length;
			} );
			if ( serviceCount > 5 ) {
				applyFormula();
				return;
			}
		}
	},
);
