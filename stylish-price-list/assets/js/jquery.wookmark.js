/*!

  jQuery Wookmark plugin

  @name jquery.wookmark.js

  @author Christoph Ono (chri@sto.ph or @gbks)

  @author Sebastian Helzle (sebastian@helzle.net or @sebobo)

  @version 1.0.4

  @date 1/27/2013

  @category jQuery plugin

  @copyright (c) 2009-2013 Christoph Ono (www.wookmark.com)

  @license Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.

*/

( function( $ ) {
	const defaultOptions = { align: 'center', container: $( 'body' ), offset: 2, autoResize: ! 1, itemWidth: 0, resizeDelay: 50 }; $.fn.wookmark = function( options ) {
		if ( options == null ) {
			options = {};
		}

		const $self = $( this[ 0 ] ); function getItemWidth( fixedWidth ) {
			if ( fixedWidth === undefined ) {
				return $self.outerWidth();
			}

			return fixedWidth;
		}

		this.wookmarkOptions = $.extend( {}, defaultOptions, options ); if ( ! this.wookmarkColumns ) {
			this.wookmarkColumns = null; this.wookmarkContainerWidth = null;
		}

		this.wookmarkLayout = function() {
			if ( ! this.wookmarkOptions.container.is( ':visible' ) ) {
				return;
			}

			const columnWidth = getItemWidth( this.wookmarkOptions.itemWidth ) + this.wookmarkOptions.offset; const containerWidth = this.wookmarkOptions.container.width(); const columns = Math.floor( ( containerWidth + this.wookmarkOptions.offset ) / columnWidth ); let offset; switch ( this.wookmarkOptions.align ) {
				case 'left':case 'right':offset = Math.floor( ( columns / columnWidth + this.wookmarkOptions.offset ) / 2 ); break; case 'center':default:offset = Math.round( ( containerWidth - ( columns * columnWidth - this.wookmarkOptions.offset ) ) / 2 ); break;
			}

			let bottom = 0; if ( this.wookmarkColumns != null && this.wookmarkColumns.length == columns ) {
				bottom = this.wookmarkLayoutColumns( columnWidth, offset );
			} else {
				bottom = this.wookmarkLayoutFull( columnWidth, columns, offset );
			}

			this.wookmarkOptions.container.css( 'height', bottom + 'px' );
		}; this.wookmarkLayoutFull = function( columnWidth, columns, offset ) {
			const heights = []; while ( heights.length < columns ) {
				heights.push( 0 );
			}

			this.wookmarkColumns = []; while ( this.wookmarkColumns.length < columns ) {
				this.wookmarkColumns.push( [] );
			}

			console.log( columns ); let item, top, left,
				i = 0,
				k = 0,
				length = this.length,
				shortest = null,
				shortestIndex = null,
				bottom = 0; for ( ;i < length; i++ ) {
				item = $( this[ i ] ); shortest = null; shortestIndex = 0; for ( k = 0; k < columns; k++ ) {
					if ( shortest == null || heights[ k ] < shortest ) {
						shortest = heights[ k ]; shortestIndex = k;
					}
				}

				const sideOffset = ( shortestIndex * columnWidth + offset ) + 'px'; if ( this.wookmarkOptions.align == 'right' ) {
					item.css( 'right', sideOffset );
				} else {
					item.css( 'left', sideOffset );
				}

				heights[ shortestIndex ] = shortest + item.outerHeight() + this.wookmarkOptions.offset; bottom = Math.max( bottom, heights[ shortestIndex ] ); if ( $( window ).width() < 415 ) {
					item.css( { width: 300 + 'px' } );
				} else {
					item.css( { position: 'absolute', top: shortest + 'px', width: 350 + 'px' } ); this.wookmarkColumns[ shortestIndex ].push( item );
				}
			}

			return bottom;
		}; this.wookmarkLayoutColumns = function( columnWidth, offset ) {
			const heights = []; while ( heights.length < this.wookmarkColumns.length ) {
				heights.push( 0 );
			}

			let i = 0,
				length = this.wookmarkColumns.length,
				column; let k = 0,
				kLength, item; let bottom = 0; for ( ;i < length; i++ ) {
				column = this.wookmarkColumns[ i ]; kLength = column.length; for ( k = 0; k < kLength; k++ ) {
					item = column[ k ]; item.css( { top: heights[ i ] + 'px' } ); const sideOffset = ( i * columnWidth + offset ) + 'px'; if ( this.wookmarkOptions.align == 'right' ) {
						item.css( 'right', sideOffset );
					} else {
						item.css( 'left', sideOffset );
					}

					heights[ i ] += item.outerHeight() + this.wookmarkOptions.offset; bottom = Math.max( bottom, heights[ i ] );
				}
			}

			return bottom;
		}; this.wookmarkResizeTimer = null; if ( ! this.wookmarkResizeMethod ) {
			this.wookmarkResizeMethod = null;
		}

		if ( this.wookmarkOptions.autoResize ) {
			this.wookmarkOnResize = function( event ) {
				if ( this.wookmarkResizeTimer ) {
					clearTimeout( this.wookmarkResizeTimer );
				}

				this.wookmarkResizeTimer = setTimeout( $.proxy( this.wookmarkLayout, this ), this.wookmarkOptions.resizeDelay );
			}; if ( ! this.wookmarkResizeMethod ) {
				this.wookmarkResizeMethod = $.proxy( this.wookmarkOnResize, this );
			}

			$( window ).resize( this.wookmarkResizeMethod ); this.wookmarkOptions.container.bind( 'refreshWookmark', this.wookmarkResizeMethod );
		} this.wookmarkClear = function() {
			if ( this.wookmarkResizeTimer ) {
				clearTimeout( this.wookmarkResizeTimer ); this.wookmarkResizeTimer = null;
			}

			if ( this.wookmarkResizeMethod ) {
				$( window ).unbind( 'resize', this.wookmarkResizeMethod ); this.wookmarkOptions.container.unbind( 'refreshWookmark', this.wookmarkResizeMethod );
			}
		}; this.wookmarkLayout(); this.show(); return this;
	};
}( jQuery ) );
